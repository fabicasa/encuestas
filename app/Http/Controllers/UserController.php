<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    public function loginTokens(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json(['res'=>false,'message'=> 'Invalid Credentials'], 200);
        }
        $tokenResult = auth()->user()->getRememberToken();
        try {

            $user=new User();
            $accessToken=$user->createToken("authToken")->accessToken;
           // $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['res' => true, 'usuario' => auth()->user(),'token'=>$accessToken]);
        } catch (\Exception $e){

        }



    }
}
