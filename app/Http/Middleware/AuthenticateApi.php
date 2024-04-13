<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->has('apiToken')) {
            $user = User::where('api_token', $request->header('apiToken'))->first();
            if ($user) {
                $request->headers->set('Accept', 'application/json');
                $request->setUserResolver(function () use ($user) {
                    return $user;
                });
                return $next($request);
            }
        }

        return response([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }
}
