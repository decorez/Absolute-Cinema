<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snack extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'image',
    ];
    public function bookings()
    {
        return $this->belongsToMany(
            Booking::class,
            'booking_snack'
        )->withPivot('quantity');
    }
}