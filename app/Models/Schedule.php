<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
   protected $fillable = [
    'movie_id',
    'show_date',
    'show_time',
    'price',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

