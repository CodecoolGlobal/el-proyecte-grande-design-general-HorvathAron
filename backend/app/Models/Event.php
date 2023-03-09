<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function created_by() {
        return $this->belongsTo(User::class);
    }

    protected $fillable =[
        'created_by',
        'title',
        'description',
        'event_date',
        'accepted'
    ];

    protected $hidden =[
        'created_at'
    ];

}
