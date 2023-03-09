<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function getAllEvents(Request $request){
        $events = Event::all();

        $response = [
            'events' => $events
        ];

        return response($response, 201);
    }

}
