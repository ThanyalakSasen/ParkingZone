<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    use HasFactory;

    protected $table = 'parking_spots';

    protected $fillable = [
        'spot_number',
        'parking_floor_id',
        'is_available',
        'spot_type',
    ];

    public function location()
    {
        return $this->belongsTo(ParkingFloor::class, 'parking_floor_id'); 
    }

    public function Reservation()
    {
        return $this->belongsTo(Reservation::class); 
    }
}
