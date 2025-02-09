<?php

namespace App\Http\Middleware\V1;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;

class JwtMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return response()->json(['status' => 'Token is Invalid'], 401);

            }

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return response()->json(['status' => 'Token Expired'], 401);

            }

            return response()->json(['status' => 'Authorization Token not found'], 401);
        }

        return $next($request);
    }
}
