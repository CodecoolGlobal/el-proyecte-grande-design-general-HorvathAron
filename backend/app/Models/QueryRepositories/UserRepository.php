<?php

namespace App\Models\QueryRepositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use App\Models\NewsFeed;

Class UserRepository{

    public static function findUser(Request $request)
    {
        return User::where('email', $request->email)->first();
    }

    public static function createUser(request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

}
