<?php

namespace App\Models\QueryRepositories;

use App\Models\Event;
use Illuminate\Http\Request;

class EventRepository
{
    public static function getAllEvents()
    {
        $events = Event::all();
        return $events;
    }

    public static function addEvent($created_by, $title, $description, $event_date)
    {
        $newEvent = [
            'created_by' => $created_by,
            'title' => $title,
            'description' => $description,
            'event_date' => $event_date];

        $event = Event::create($newEvent);

        return $event->id;
    }
}
