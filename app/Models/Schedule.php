<?php

// I made this to be referenced by Reservation to get predetermined time slots.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id');
    }
}
