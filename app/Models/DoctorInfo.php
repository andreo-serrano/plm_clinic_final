<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    use HasFactory;

    
    protected $table = 'doctorinfo';

    // Specify the primary key of the table
    protected $primaryKey = 'doctorID';

    // Fillable attributes for mass assignment
    protected $fillable = ['peremail', 'mobnum', 'emergencymobnum'];
}
