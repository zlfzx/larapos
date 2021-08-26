<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return $this->unauthorized(null, 'Token is Invalid');
            } else if ($e instanceof TokenExpiredException) {
                try {
                    // refresh token
                    $oldToken = JWTAuth::getToken();
                    $newToken = JWTAuth::refresh($oldToken);

                    $request->headers->set('Authorization', 'Bearer ' . $newToken);
                } catch (TokenExpiredException $e) {
                    return $this->unauthorized($e->getMessage(), 'Token is Expired');
                }

                return $this->unauthorized($newToken, 'Token is Expired');
            } else {
                return $this->unauthorized(null, 'Authorization Token not found');
            }
        }

        return $next($request);
    }
}
