<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'reservations';
    protected $fillable = [
        'student_user_id',
        'resource_id',
        'schedule_id',
        'reservation_date'
    ];

public function user()
{
    // usage: $reservation->user
    return $this->belongsTo(User::class, 'student_user_id'); 
}

/* remember to make the relationship work again, create schedule model

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
*/

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }


}