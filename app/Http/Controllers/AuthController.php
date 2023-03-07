<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['meta' => [
                'success' => false,
                'errors' => [
                    'Password incorrect for: '.$request->username
                ]
            ]], 401);
        }

        return response()->json(
        [
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => [
                'token' => $token,
                'minutes_to_expire' => auth('api')->factory()->getTTL()
            ]
        ], 200);
    }

}