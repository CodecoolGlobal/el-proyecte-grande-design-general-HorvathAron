<?php

namespace App\Models\QueryRepositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

Class UserRepository{

    public static function findUser(Request $request)
    {
        return User::where('email', $request->email)->first();
    }


    public static function createUser(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

}
