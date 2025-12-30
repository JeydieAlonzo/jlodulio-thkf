<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'section_name',
        'description',
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class, 'Section_section_id', 'section_id');
    }
}

