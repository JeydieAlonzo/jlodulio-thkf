<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    // protected $table = 'schedules';

    // protected $primaryKey = 'schedule_id';

    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id');
    }
}
