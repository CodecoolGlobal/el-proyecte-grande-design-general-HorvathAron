<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    function getParticipantsByEventId(Request $request)
    {
        $participants = DB::table('participants')
                            ->where('event_id', $request->eventId)
                            ->join('users', 'user_id', '=', 'users.id')
                            ->select('users.id', 'users.name', 'users.email')
                            ->get();

        $response = [
            'participants' => $participants
        ];

        return response($response, 201);

    }

    function getEventsByUserId(Request $request) {

        $events = DB::table('participants')->where('user_id', $request->userId)
            ->join('events', 'event_id', '=', 'events.id')
            ->select('events.id', 'events.title', 'events.description', 'events.created_at', 'events.event_date', 'accepted')
            ->get();

        $response = [
            'events' => $events
        ];

        return response($response, 201);



    }
}
