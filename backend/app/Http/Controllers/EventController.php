<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\QueryRepositories\EventRepository;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    function getAllEvents(Request $request): void
    {
        $response = [
            'events' => EventRepository::getAllEvents()
        ];

        return response($response, 201);
    }

    function addEvent(Request $request): void
    {
        if (!$request->has('created_by') || $request->created_by == null ||
            !$request->has('title') || $request->title == null ||
            !$request->has('description') || $request->description == nul ||
            !$request->has('event_date') || $request->event_date == null) return response(["message" => 'Error! Could not create event!'], Response::HTTP_NOT_FOUND);
        else {
            $id = EventRepository::addEvent($request->created_by, $request->title, $request->description, $request->event_date);
            return response(["id" => $id], Response::HTTP_CREATED);
        }
    }
}
