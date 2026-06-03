<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Studio;
use App\Models\Movie;
use App\Models\Booking;

class Schedule extends Model
{
   protected $fillable = [
    'movie_id',
    'studio_id',
    'show_date',
    'show_time',
    'price',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

