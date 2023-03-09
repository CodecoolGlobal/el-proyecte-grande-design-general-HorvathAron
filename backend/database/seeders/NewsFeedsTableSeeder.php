<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NewsFeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news_feeds')->insert([
            "created_by" => 1,
            "eventId" =>1,
            "message"=> "heyoo!!"
        ]);
    }
}
