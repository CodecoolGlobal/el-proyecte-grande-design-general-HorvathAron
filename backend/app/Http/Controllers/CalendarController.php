<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryRepositories\CalendarRepository;

class CalendarController extends Controller
{
    function getEventsByMonth(Request $request)
    {
        return CalendarRepository::getEventsByUser($request->query('month'),$request->query('year'), $request->query('userId'));
    }

    function getParticipatedEvents(Request $request)
    {
        return CalendarRepository::getParticipatedEvents($request->query('month'),$request->query('year'), $request->query('userId'));
    }

    function getEventsByDate(Request $request)
    {
        return CalendarRepository::getEventsByDate($request->query('year'), $request->query('month'), $request->query('day'));
    }
}
