<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants() {
        return $this->hasMany(Participant::class, 'event_id');
    }

    public function tags(){
        return $this->hasMany(EventsTags::class, 'event_id');
    }

    // Ezek UPDATE-elhetőek, illetve új létrehozáskor ezeket lehet megadni.
    protected $fillable =[
        'created_by',
        'title',
        'description',
        'event_date',
        'accepted'
    ];

    // $hidden select-nél ezeket nem rakja bele.

    public function feed(): HasMany
    {
        return $this->hasMany(NewsFeed::class, 'eventId');
    }

}
