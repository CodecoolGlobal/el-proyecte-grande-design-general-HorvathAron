<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\Userrepository;

class UserController extends Controller
{
    //
    function login(Request $request)
    {
        $user = Userrepository::findUser($request);
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    function register(Request $request)
    {
        UserRepository::createUser($request);

        $user = Userrepository::findUser($request);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Could not create user']
            ], 404);

        }
        $response = [
            'user' => $user,
        ];

         return response($response, 201);
    }
}
