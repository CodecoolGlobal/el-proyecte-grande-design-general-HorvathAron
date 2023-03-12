<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\QueryRepositories\EventRepository;

class EventController extends Controller
{
    function getAllEvents(Request $request)
    {
        $response = [
            'events' => EventRepository::getAllEvents()
        ];

        return response($response, 201);
    }
}
