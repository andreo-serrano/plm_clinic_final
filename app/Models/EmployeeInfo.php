<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    use HasFactory;

    protected $table = 'employeeinfo';

    // Specify the primary key of the table
    protected $primaryKey = 'employeeID';

    // Fillable attributes for mass assignment
    protected $fillable = ['peremail', 'mobnum', 'emergencymobnum'];
}
