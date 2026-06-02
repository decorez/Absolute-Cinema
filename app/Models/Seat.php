<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'studio_id',
        'seat_number',
        'is_booked',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }
}