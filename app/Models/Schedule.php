<?php

// I made this to be referenced by Reservation to get predetermined time slots.

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['start_time', 'end_time'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id');
    }
}
