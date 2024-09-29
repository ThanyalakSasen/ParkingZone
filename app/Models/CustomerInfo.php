<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;


    protected $table = 'vehicle_infos';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'id_card',
        'line_id',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
