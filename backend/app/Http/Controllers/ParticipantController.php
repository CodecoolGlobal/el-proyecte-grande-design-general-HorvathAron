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

    function getEventsByUserId(Request $request)
    {
        $response = [
            'events' => ParticipantRepository::getEventsByUserId($request->userId)
        ];

        return response($response, 201);
    }
}
