<?php

namespace App\Models\QueryRepositories;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRepository
{
    public static function getAllEvents()
    {
        $events = Event::all();
        return $events;
    }

    public static function getEventById($id){
        $event = DB::table('events')
            ->where('id','=', $id)
            ->get();

        return $event;
    }

    public static function addEvent($created_by, $title, $description, $event_date)
    {
        $id=DB::table('events')->insertGetId([
            'created_by' => $created_by,
            'title' => $title,
            'description' => $description,
            'event_date' => $event_date]);

        return $id;
    }

    public static function deleteEvent($id): int {
        $rowsCount = DB::table('events')
            ->where('id', '=', $id)
            ->delete();

        return $rowsCount;
    }

    public static function getAllEventsWithParticipants() {
        $events = DB::table('events')
                    ->join('participants', 'events.id', '=', 'participants.event_id')
                    ->get();
        return $events;
    }
}
