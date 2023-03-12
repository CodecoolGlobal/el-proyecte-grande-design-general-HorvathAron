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
}
