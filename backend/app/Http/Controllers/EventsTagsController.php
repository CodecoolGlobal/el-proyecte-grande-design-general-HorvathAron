<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QueryRepositories\EventsTagsRepository;

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
}
