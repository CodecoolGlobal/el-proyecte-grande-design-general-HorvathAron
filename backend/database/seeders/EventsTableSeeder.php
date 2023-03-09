<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            'created_by'=> 1,
            'title' => 'Test event',
            'description' => 'This is the description of the test event',
            'event_date'=> new \DateTime('today')
        ]);

        DB::table('events')->insert([
            'created_by'=> 1,
            'title' => 'Second Test event',
            'description' => 'This is the description of the second test event',
            'event_date'=> new \DateTime('today')
        ]);


    }
}
