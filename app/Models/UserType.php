<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use HasFactory, SoftDeletes;

    // Add this line to tell Laravel the correct table name
    protected $table = 'usertypes'; // Change 'usertypes' to whatever your table is actually named

    protected $fillable = ['role']; // Update with your actual columns
}