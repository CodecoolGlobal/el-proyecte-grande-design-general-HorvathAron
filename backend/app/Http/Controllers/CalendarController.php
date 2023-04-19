<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryRepositories\CalendarRepository;

class CalendarController extends Controller
{
    function getEventsByMonth(Request $request)
    {
        return CalendarRepository::getEventsByMonth($request->query('month'),$request->query('year'), $request->query('userId'));
    }

    function getParticipatedEvents(Request $request)
    {
        return CalendarRepository::getParticipatedEvents($request->query('month'),$request->query('year'), $request->query('userId'));
    }
}
