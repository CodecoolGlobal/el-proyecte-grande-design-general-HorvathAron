<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\QueryRepositories\EventRepository;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    function getAllEvents(Request $request)
    {
        $response = [
            'events' => EventRepository::getAllEvents()
        ];

        return response($response, 201);
    }

    function addEvent(Request $request)
    {
        if (!$request->has('created_by') || $request->created_by == null ||
            !$request->has('title') || $request->title == null ||
            !$request->has('description') || $request->description == null ||
            !$request->has('event_date') || $request->event_date == null) return response(["message" => "Could not create event!"], Response::HTTP_NOT_FOUND);
        else {
            $id = EventRepository::addEvent($request->created_by, $request->title, $request->description, $request->event_date);
            return response(["id" => $id], Response::HTTP_CREATED);
        }
    }

    function deleteEvent(Request $request) {
        if (!$request->has('id') || $request->id == null) return response(["message" => 'Error! No id was given!'], Response::HTTP_NOT_FOUND);
        else {
            $rowsCount = EventRepository::deleteEvent($request->id);
            if ($rowsCount!=0) return \response(["message"=>"Event deleted."], Response::HTTP_OK);
            else return \response(["message"=>"Error! Could not delete event!"], Response::HTTP_NOT_FOUND);
        }
    }
}
