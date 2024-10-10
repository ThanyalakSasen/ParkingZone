<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'promotions';

    protected $fillable = [
        'festival_name',
        'start_date',
        'end_date',
        'vehicle_type',
        'hourly_price',
        'daily_price',
        'hourly_discounted',
        'daily_discounted',
    ];

    // ความสัมพันธ์ One-to-Many กับ Reservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
