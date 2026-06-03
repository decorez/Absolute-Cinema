<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'name',
        'type',
        'capacity',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
