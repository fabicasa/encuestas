<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            "name" => $request->json('name'),
            "email" => $request->json('email'),
            "password" => bcrypt($request->json('password')
            ),
        ]);
        return response()->json([
            "res" => "success",
            "data" => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
           // $token = $tokenResult->token;
            return response()->json([
                "res" =>"success",
                'access_token' => $tokenResult->accessToken,
            ]);
        }
        return response()->json(
            ['res' => 'error',
                'message' => 'Unauthorized'
            ], 401
        );
    }

}
