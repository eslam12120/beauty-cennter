<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('auth-token');
        $request->headers->set('auth-token', (string) $token, true);
        $request->headers->set('Authorization', 'Bearer ' . $token, true);
        if (Auth::guard('user-api')->check()) {
            try {
                JWTAuth::parseToken()->authenticate();
            } catch (Exception $exception) {
                if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return response()->json('Invalid Exception');
                } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return response()->json('Expired Exception');
                } else {
                    return response()->json('please login and return go to request ');
                }
            }
            return $next($request);
        }
        return response()->json('please login and return go to request , Invalid Token Freelancer');

        return response()->json('Enter Token');
    }
}