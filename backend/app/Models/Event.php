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

    // Ezek UPDATE-elhetőek, illetve új létrehozáskor ezeket lehet megadni.
    protected $fillable =[
        'created_by',
        'title',
        'description',
        'event_date',
        'accepted'
    ];

    // $hidden select-nél ezeket nem rakja bele.

}
