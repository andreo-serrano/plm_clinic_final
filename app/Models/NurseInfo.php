<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseInfo extends Model
{
    use HasFactory;

    protected $table = 'nurseinfo';

    // Specify the primary key of the table
    protected $primaryKey = 'nurseID';

    // Fillable attributes for mass assignment
    protected $fillable = ['peremail', 'mobnum', 'emergencymobnum'];
}
