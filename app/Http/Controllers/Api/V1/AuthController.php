<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->unauthorized(null, 'Invalid Credentials');
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);

        return $this->ok('Succcessfully logout');
    }

    protected function respondWithToken($token)
    {
        return $this->ok([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60
        ]);
    }
}
