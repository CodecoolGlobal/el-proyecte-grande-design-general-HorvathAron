<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\Userrepository;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    function getUsers(){
        return User::all();
    }

    function register(Request $request)
    {
        UserRepository::createUser($request);

        $user = Userrepository::findUser($request);
        return $user;
    }

    function login(Request $request)
    {
        $user = Userrepository::findUser($request);
        if (!$user) {
            $user = $this->register($request);
        }

        $token = $user->createToken('bearer')->plainTextToken;
        $response = [
            'token' => $token
        ];

        return response($response, 201);
    }

    function logout(){
        $token = request()->bearerToken();
        $pAToken = PersonalAccessToken::findToken($token);
        if (!$pAToken) {
            $pAToken=null;
        }
        $user = $pAToken->tokenable;
        $user->tokens()->delete();
        $response = [
            'message' => "user sucessfully logged out"
        ];
        return response($response, 201);
    }

    function getMe(){
        $token = request()->bearerToken();
        $pAToken = PersonalAccessToken::findToken($token);
        $user = $pAToken->tokenable;
        $response = [
            'user' => $user
        ];
        return response($response, 201);
    }


}
