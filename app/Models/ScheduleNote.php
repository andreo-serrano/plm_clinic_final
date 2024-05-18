<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleNote extends Model
{
    use HasFactory;

    protected $table = 'schedulenotes';

    protected $fillable = [
        'univnum',
        'todo_date',
        'todo_title',
        'todo_startTime',
        'todo_endTime',
        // Add other fillable fields here if needed
    ];

}
