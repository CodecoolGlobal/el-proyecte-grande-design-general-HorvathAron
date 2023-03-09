<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            "name"=> "Fighting-game"
        ]);

        DB::table('tags')->insert([
            "name"=> "Fps"
        ]);

        DB::table('tags')->insert([
            "name"=> "Rpg"
        ]);

        DB::table('tags')->insert([
            "name"=> "Concert"
        ]);

        DB::table('tags')->insert([
            "name"=> "Friday night"
        ]);

        DB::table('tags')->insert([
            "name"=> "Airsoft"
        ]);

        DB::table('tags')->insert([
            "name"=> "Lasertag"
        ]);

        DB::table('tags')->insert([
            "name"=> "Online"
        ]);

        DB::table('tags')->insert([
            "name"=> "School"
        ]);
    }
}
