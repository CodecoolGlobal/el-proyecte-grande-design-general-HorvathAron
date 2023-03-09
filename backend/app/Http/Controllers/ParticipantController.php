<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    function getParticipantsByEventId(Request $request)
    {
        $participants = DB::table('participants')->where('event_id', $request->eventId)
            ->join('users', 'user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        $response = [
            'participants' => $participants
        ];

        return response($response, 201);

    }
}
