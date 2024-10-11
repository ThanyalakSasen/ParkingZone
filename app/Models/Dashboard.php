<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use HasFactory; 
    // use SoftDeletes;

    protected $fillable = [
        'shipping_type',
        'vehicle_type',
        'license_plate',
        'date_entry',
        'date_exit',
        'duration',
        'time_start',
    ];

    protected $casts = [
        'date_entry' => 'datetime',
        'date_exit' => 'datetime',
    ];

    
}
