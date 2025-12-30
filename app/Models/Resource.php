<?php

// I made this to catch the relationships between Resourcce and Section and Reservation.

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'resources';

    protected $fillable = [
        'resource_type',
        'resource_name',
        'description',
        'availability',
        'section_id',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id', 'id')->withTrashed();
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'Resource_resource_id', 'id');
    } 

}