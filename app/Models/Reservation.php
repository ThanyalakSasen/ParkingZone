<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'booking_date',
        'start_time',
        'end_time',
        'reservation_number',
        'parking_type',
        'license_plate',
        'parking_status',
        'price',
    ];
}
