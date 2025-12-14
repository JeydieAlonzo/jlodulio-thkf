<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    protected $table = 'resources';

    protected $fillable = [
        'resource_type',
        'resource_name',
        'description',
        'availability',
        'Section_section_id',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'Section_section_id', 'section_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'Resource_resource_id', 'id');
    } 

}