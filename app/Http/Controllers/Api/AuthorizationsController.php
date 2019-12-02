<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Support\Facades\Auth;

class AuthorizationsController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(AuthorizationRequest $request)
    {
        $credentials = [
            'email'    => $request->username,
            'password' => $request->password,
        ];

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->errorUnauthorized('用户名或密码错误');
        }
        return $this->respondWithToken($token);

    }


    // 响应 token
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60
        ], 201);
    }


    public function refresh()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }


    // 删除 token
    public function logout()
    {
        Auth::guard('api')->logout();
        // return $this->noContent();
        return response(['message' => '你已退出登录!']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

}
