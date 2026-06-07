<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;
use App\Models\BookingDetail;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_id',
        'booking_code',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }
    public function snacks()
    {
        return $this->belongsToMany(
            Snack::class,
            'booking_snack'
        )->withPivot('quantity');
    }
}
