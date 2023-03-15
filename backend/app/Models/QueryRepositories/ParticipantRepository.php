<?php

namespace App\Models\QueryRepositories;

use Illuminate\Http\Request;
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

    public static function getEventsByUserId(int $userId): Collection
    {
        $events = DB::table('participants')->where('user_id', $userId)
            ->join('events', 'event_id', '=', 'events.id')
            ->select('events.id', 'events.title', 'events.description', 'events.created_at', 'events.event_date', 'accepted')
            ->get();

        return $events;
    }

    public static function addParticipantToEvent($event_id, $user_id): int
    {
        $id = DB::table('participants')->insertGetId([
            'event_id' => $event_id,
            'user_id' => $user_id]);

        return $id;
    }

    public static function deleteParticipantFromEvent($event_id, $user_id): int
    {
        $rowsCount = DB::table('participants')
            ->where('event_id', '=', $event_id)
            ->where('user_id', '=', $user_id)
            ->delete();

        return $rowsCount;
    }
}
