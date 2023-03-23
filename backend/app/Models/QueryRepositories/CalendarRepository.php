<?php

namespace App\Models\QueryRepositories;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CalendarRepository{



public static function getEventsByMonth(int $month, int $year, int $userId)
{
    return DB::table('events')->where('created_by', $userId )->whereMonth('event_date', $month)->whereYear('event_date', $year)->get();
}

}