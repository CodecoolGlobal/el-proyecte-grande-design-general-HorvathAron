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

    public static function addEvent($created_by, $title, $description, $event_date)
    {
        $id=DB::table('events')->insertGetId([
            'created_by' => $created_by,
            'title' => $title,
            'description' => $description,
            'event_date' => $event_date]);

        return $id;

//        $newEvent = [
//            'created_by' => $created_by,
//            'title' => $title,
//            'description' => $description,
//            'event_date' => $event_date];
//
//        $event = Event::create($newEvent);
//
//        return $event->id;
    }

    public static function deleteEvent($id): int {
        $rowsCount = DB::table('events')->where('id', '=', $id)->delete();
        return $rowsCount;
    }
}
