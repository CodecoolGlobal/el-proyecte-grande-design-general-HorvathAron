<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $fillable =[
        'created_by',
        'title',
        'description',
        'event_date',
        'accepted'
    ];

    public function feed(): HasMany
    {
        return $this->hasMany(NewsFeed::class, 'eventId');
    }

}
