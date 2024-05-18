<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'details',
        'provider',
        'ex_date',
        'ex_time',
        // Add other fillable fields here if needed
    ];

}
