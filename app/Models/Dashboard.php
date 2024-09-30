<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shipping_type',
        'vehicle_type',
        'license_plate',
        'date_entry',
        'date_exit',
        'duration',
    ];

    protected $casts = [
        'date_entry' => 'datetime',
        'date_exit' => 'datetime',
    ];

    public function isOverdue()
    {
        return $this->dateExit < now();
    }

    // public function carInfo()
    // {
    //     return $this->belongsTo(CarInfo::class, 'license_plate', 'license_plate'); // เชื่อมโยงกับ CarInfo
    // }
}
