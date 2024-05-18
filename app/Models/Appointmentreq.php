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
        'request_type',
        'reason',
        'date',
        'time',
        // Add other fillable fields here if needed
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $count = static::count();
            $id = 'A' . now()->format('Y') . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
            $model->id = $id;
        });
    }
}
