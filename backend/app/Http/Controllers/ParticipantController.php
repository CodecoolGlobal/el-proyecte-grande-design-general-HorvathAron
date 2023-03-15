<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\ParticipantRepository;
use Symfony\Component\HttpFoundation\Response;

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

    function addParticipantToEvent(Request $request)
    {
        if (!$request->has('event_id') || $request->event_id == null ||
            !$request->has('user_id') || $request->user_id==null) return response(["message"=>"Could not add participant!"], Response::HTTP_NOT_FOUND);
        else {
            $id = ParticipantRepository::addParticipantToEvent($request->event_id, $request->user_id);
            return \response(["id"=>$id], Response::HTTP_CREATED);
        }
    }
}
