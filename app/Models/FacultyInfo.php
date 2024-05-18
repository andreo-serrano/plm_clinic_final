<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyInfo extends Model
{
    use HasFactory;

    protected $table = 'facultyinfo';

    // Specify the primary key of the table
    protected $primaryKey = 'facultyID';

    // Fillable attributes for mass assignment
    protected $fillable = ['peremail', 'mobnum', 'emergencymobnum'];
}
