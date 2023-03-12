<?php

namespace App\Models\QueryRepositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsTagsRepository
{
    public static function getTagsByEventId(int $eventId)
    {
        $tags = DB::table('events_tags')
            ->where('event_id', $eventId)
            ->join('tags', 'tag_id', '=', 'tags.id')
            ->select('tags.id', 'tags.name')
            ->get();

        return $tags;
    }

    public static function getEventsByTagId(int $tagId)
    {
        $events = DB::table('events_tags')
            ->where('tag_id', $tagId)
            ->join('events', 'event_id', '=', 'events.id')
            ->select('events.id', 'events.created_by', 'events.title', 'events.description', 'events.created_at', 'events.event_date')
            ->get();

        return $events;
    }
}
