<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'studentinfo';

    // Specify the primary key of the table
    protected $primaryKey = 'studentID';

    // Fillable attributes for mass assignment
    protected $fillable = ['peremail', 'mobnum', 'guardmobnum'];
}
