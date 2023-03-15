<?php

namespace App\Http\Controllers;

use App\Models\QueryRepositories\ParticipantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\EventsTagsRepository;
use Symfony\Component\HttpFoundation\Response;

class EventsTagsController extends Controller
{
    function getTagsByEventId(Request $request)
    {
        $response = [
            'tags' => EventsTagsRepository::getTagsByEventId($request->eventId)
        ];

        return response($response, 201);
    }

    function getEventsByTagId(Request $request)
    {
        $response = [
            'events' => EventsTagsRepository::getEventsByTagId($request->tagId)
        ];

        return response($response, 201);
    }

    function deleteTagForEvent(Request $request){
        if (!$request->has('event_id') || $request->event_id == null ||
            !$request->has('tag_id') || $request->tag_id == null) return response(["message" => "Insufficient parameters!"], Response::HTTP_NOT_FOUND);
        else {
            $rowsCount = EventsTagsRepository::deleteTagForEvent($request->event_id, $request->tag_id);
            if ($rowsCount!=0) return \response(["message"=>"Tag deleted for event."], Response::HTTP_OK);
            else return \response(["message"=>"Error! Could not delete tag for event!"], Response::HTTP_NOT_FOUND);
        }
    }

    function addTagForEvent(Request $request) {
        if (!$request->has('event_id') || $request->event_id == null ||
            !$request->has('tag_id') || $request->tag_id == null) return response(["message" => "Insufficient parameters!"], Response::HTTP_NOT_FOUND);
        else {
            $id = EventsTagsRepository::addTagForEvent($request->event_id, $request->tag_id);
            return \response(['id'=>$id], Response::HTTP_OK);
        }
    }
}
