<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\ParticipantRepository;

class ParticipantController extends Controller
{
    function getParticipantsByEventId(Request $request)
    {
        $response = [
            'participants' => ParticipantRepository::getParticipantsByEventId($request->eventId)
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
