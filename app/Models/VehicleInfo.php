<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInfo extends Model
{
    use HasFactory;


    protected $table = 'vehicle_infos';

    protected $fillable = [
        'user_id',
        'license_plate',
        'province',
        'vehicle_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
