<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsTagsController extends Controller
{
    function getTagsByEventId(Request $request){
        $tags = DB::table('events_tags')
                    ->where('event_id', $request->eventId)
                    ->join('tags', 'tag_id', '=', 'tags.id')
                    ->select('tags.id', 'tags.name')
                    ->get();

        $response = [
            'tags' => $tags
        ];

        return response($response, 201);
    }

    function getEventsByTagId(Request $request){
        $events = DB::table('events_tags')
            ->where('tag_id', $request->tagId)
            ->join('events', 'event_id', '=', 'events.id')
            ->select('events.id', 'events.created_by', 'events.title', 'events.description', 'events.created_at', 'events.event_date')
            ->get();

        $response = [
            'events' => $events
        ];

        return response($response, 201);
    }


}
