<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleOAuthController extends Controller
{
    function auth($desktopAppRedirectUrl = null)
    {

        session()->forget('desktopAppRedirectUrl');

        if ($desktopAppRedirectUrl) {

            session()->put('desktopAppRedirectUrl', $desktopAppRedirectUrl);

            if (Auth::check()) {
                return $this->redirectToDriveScopeOAuthUrl();
            }
        }

        return redirect(
            $this->getOAuthUrl(
                'email profile',
                route('google.oAuth.callback.profileScope')
            )
        );
    }

    function callbackProfileScope(Request $request)
    {
        if ($request->has('code')) {
            $cl = curl_init();
            curl_setopt_array($cl, [
                CURLOPT_URL => 'https://oauth2.googleapis.com/token',
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => [
                    'code' => $request->get('code'),
                    'client_id' => getenv('GOOGLE_APP_CLIENT_ID'),
                    'client_secret' => getenv('GOOGLE_APP_CLIENT_SECRET'),
                    'redirect_uri' => route('google.oAuth.callback.profileScope'),
                    'grant_type' => 'authorization_code'
                ]
            ]);

            $resp = json_decode(curl_exec($cl));

            if (isset($resp->access_token)) {

                $cl = curl_init();
                curl_setopt_array($cl, [
                    CURLOPT_URL => 'https://www.googleapis.com/oauth2/v1/userinfo',
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => [
                        'Authorization: Bearer ' . $resp->access_token
                    ]
                ]);

                $resp = json_decode(curl_exec($cl));

                if (
                    isset($resp->email) &&
                    isset($resp->name) &&
                    isset($resp->picture)
                ) {
                    $identityToken = sha1($resp->email . uniqid(rand(1000, 9999)));

                    $user = User::firstOrCreate(
                        ['email' => $resp->email],
                        [
                            'name' => $resp->name,
                            'picture' => $resp->picture,
                            'identity_token' => $identityToken,
                        ]
                    );

                    Auth::login($user, true);

                    if (session()->has('desktopAppRedirectUrl')) {
                        return $this->redirectToDriveScopeOAuthUrl();
                    } else {
                        //redirect to dashboard
                        return 'dashboard';
                    }
                }
            }
        }
        return response('Bad request', 400);
    }

    function callbackDriveScope(Request $request)
    {
        if ($request->has('code')) {
            $cl = curl_init();
            curl_setopt_array($cl, [
                CURLOPT_URL => 'https://oauth2.googleapis.com/token',
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => [
                    'code' => $request->get('code'),
                    'client_id' => getenv('GOOGLE_APP_CLIENT_ID'),
                    'client_secret' => getenv('GOOGLE_APP_CLIENT_SECRET'),
                    'redirect_uri' => route('google.oAuth.callback.driveScope'),
                    'grant_type' => 'authorization_code'
                ]
            ]);

            $resp = json_decode(curl_exec($cl));

            if (
                isset($resp->access_token) &&
                isset($resp->refresh_token)
            ) {

                return view('redirectToDesktopApp', [
                    'redirectUrl' => session('desktopAppRedirectUrl') . '?data=' . json_encode([
                        'googleApiRefreshToken' => $resp->refresh_token,
                        'screenwaveWebIdentityToken' => Auth::user()->identity_token
                    ])
                ]);
            }
        }
        return response('Bad request', 400);
    }

    private function redirectToDriveScopeOAuthUrl()
    {
        return redirect(
            $this->getOAuthUrl(
                'https://www.googleapis.com/auth/drive.file',
                route('google.oAuth.callback.driveScope')
            )
        );
    }

    private function getOAuthUrl($scope, $redirectUrl)
    {
        $googleOAuthQueryParams = [
            'client_id' => getenv('GOOGLE_APP_CLIENT_ID'),
            'response_type' => 'code',
            'access_type' => 'offline',
            'include_granted_scopes' => 'true',
            'scope' => $scope,
            'redirect_uri' => $redirectUrl,
        ];
        return "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($googleOAuthQueryParams);
    }
}
