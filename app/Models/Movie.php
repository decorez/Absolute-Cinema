<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
    'title',
    'description',
    'genre',
    'duration',
    'release_date',
    'poster',
    ];
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}


