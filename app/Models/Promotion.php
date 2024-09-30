<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'festival_name',
        'start_date',
        'end_date',
        'hourly_price',
        'daily_price',
        'monthly_price',
        'hourly_discounted',
        'daily_discounted',
        'monthly_discounted',
    ];
}
