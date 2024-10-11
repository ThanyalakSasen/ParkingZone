<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'dashboard_id',
        'user_id',
        'booking_date',
        'time_start',
        'end_time',
        'spot_number',
        'parking_type',
        'license_plate',
        'parking_status',
        'price',
    ];

    public function ParkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class, 'spot_number', 'spot_number');
    }

    // สร้างความสัมพันธ์แบบ One-to-One กับ Dashboard
    // public function dashboard()
    // {
    //     return $this->hasOne(Dashboard::class, 'dashboard_id', 'dashboard_id');
    // }

    // เพิ่มความสัมพันธ์กับ Model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class, 'dashboard_id');
    }
}
