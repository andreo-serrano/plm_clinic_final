<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmentreq extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'univnum',
        'reason',
        'date',
        'time',
        // Add other fillable fields here if needed
    ];
}
