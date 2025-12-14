<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';
    protected $fillable = [
        'student_user_id', // fk to users table, takes user_id of user with usertype 'student'
        'resource_id', // fk to resources table, usually gets translated to the type of the resource - may include also to fetch name/description
        'schedule_id', // fk to schedules table, responds to time slots premade
        'reservation_date', // date of reservation in YYYY-MM-DD format
        'reservation_description', // text description/reason for reservation, material details, and librarian notes for decline or approval
        'reservation_start_time', // time field for start time of reservation session in HH:MM:SS format
        'reservation_end_time', // time field for end time of reservation session in HH:MM:SS format
        'librarian_user_id', // fk to users table, takes user_id of user with usertype 'librarian' who edits the reservation
    ];

public function user()
    {
    // usage: $reservation->user
    return $this->belongsTo(User::class, 'student_user_id'); 
    }

public function schedule()
    {
    // usage: $reservation->schedule
    return $this->belongsTo(Schedule::class, 'schedule_id');
    }


public function resource(): BelongsTo
    {
    // usage: $reservation->resource
    return $this->belongsTo(Resource::class, 'resource_id');
    }

}
