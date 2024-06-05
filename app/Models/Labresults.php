<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labresults extends Model
{
    use HasFactory;

    protected $table = 'labresults';
    protected $fillable = ['appid', 'univnum', 'current_condition', 'diagnosis', 'treatment_plan', 'remarks',  'lab_results_file']; // Add more fields as needed
}
