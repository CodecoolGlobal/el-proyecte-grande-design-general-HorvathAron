<?php

namespace App\Models\QueryRepositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ParticipantRepository
{
    public static function getParticipantsByEventId(int $eventId): Collection
    {
        $participants = DB::table('participants')
            ->where('event_id', $eventId)
            ->join('users', 'user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email')
            ->get();

        return $participants;
    }
}
