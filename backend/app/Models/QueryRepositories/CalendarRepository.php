<?php

namespace App\Models\QueryRepositories;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CalendarRepository{



public static function getEventsByUser(int $month, int $year, int $userId)
{
    return DB::table('events')
        ->where('created_by', $userId )
        ->whereMonth('event_date', $month)
        ->whereYear('event_date', $year)->get();
}

public static function getParticipatedEvents(int $month, int $year, int $userId)
{
    return DB::table('events')
        ->join('participants', 'event_id', '=', 'events.id')
        ->where('user_id',$userId)
        ->whereMonth('event_date', $month)
        ->whereYear('event_date', $year)
        ->get();
}

public static function getEventsByDate(int $year, int $month, int $day)
{
    return DB::table('events')
        ->whereDay('event_date', $day )
        ->whereMonth('event_date', $month)
        ->whereYear('event_date', $year)->get();
}

}
