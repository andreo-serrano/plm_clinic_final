<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvalmodel1 extends Model
{
    use HasFactory;

    protected $table = 'appdentalreqs';

    protected $fillable = [
        'appid', 'type', 'date', 'time', 'patient_concern', 'remarks', 'status'
    ];
}
