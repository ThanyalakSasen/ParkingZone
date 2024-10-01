<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingFloor extends Model
{
    use HasFactory;

    protected $table = 'parking_floors';

    protected $fillable = [
        'name',
        'floor',
    ];

    public function parkingSpots()
    {
        return $this->hasMany(ParkingSpot::class, 'parking_floor_id');
    }
}
