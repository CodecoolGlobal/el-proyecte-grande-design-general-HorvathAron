<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsTags extends Model
{
    use HasFactory;

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    protected $fillable =[
        'event_id',
        'tag_id'
    ];
}
