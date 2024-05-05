<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GoogleOAuthController extends Controller
{
    function auth($sessionId = null)
    {

        session()->forget('sessionId');

        if ($sessionId) {

            session()->put('sessionId', $sessionId);

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

    function generateAuthToken(Request $request)
    {

        $request->validate([
            'refreshToken' => 'required'
        ]);

        $cl = curl_init();
        curl_setopt_array($cl, [
            CURLOPT_URL => 'https://oauth2.googleapis.com/token',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => [
                'refresh_token' => $request->get('refreshToken'),
                'client_id' => getenv('GOOGLE_APP_CLIENT_ID'),
                'client_secret' => getenv('GOOGLE_APP_CLIENT_SECRET'),
                'grant_type' => 'refresh_token'
            ]
        ]);

        $resp = json_decode(curl_exec($cl));

        if (isset($resp->access_token)) {
            return response([
                'success' => true,
                'data' => $resp
            ]);
        }

        return response([
            'success' => false,
            'message' => 'Unable to generate authentication token',
            'data' =>  $resp
        ], curl_getinfo($cl, CURLINFO_HTTP_CODE));
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
                    $apiToken = sha1($resp->email . uniqid(rand(1000, 9999)));

                    $user = User::firstOrCreate(
                        ['email' => $resp->email],
                        [
                            'name' => $resp->name,
                            'picture' => $resp->picture,
                            'api_token' => $apiToken,
                        ]
                    );

                    Auth::login($user, true);

                    if (session('sessionId')) {
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

                $encryptRefreshToken = Crypt::encryptString($resp->refresh_token);

                $user = User::find(Auth::id());
                $user->google_refresh_token = $encryptRefreshToken;
                $user->save();

                $sessionId = session('sessionId');

                session()->setId($sessionId);
                session()->put('apiToken', Auth::user()->api_token);
                session()->put('refreshToken', $resp->refresh_token);

                return "<h1><span style='color: green;'>Ma-Shaa'-Allah!</span> Google Drive is connected. You may close the browser.</h1>";
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
