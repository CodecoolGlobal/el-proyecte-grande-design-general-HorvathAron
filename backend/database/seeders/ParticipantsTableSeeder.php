<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participants')->insert([
            'event_id' => 1,
            'user_id' => 1
        ]);

        DB::table('participants')->insert([
            'event_id' => 1,
            'user_id' => 2
        ]);

    }
}
