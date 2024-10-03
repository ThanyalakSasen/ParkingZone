<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInfo extends Model
{
    use HasFactory;
    // กำหนดชื่อของตารางในฐานข้อมูล (สามารถละเว้นได้ถ้าตารางมีชื่อสอดคล้องกับ Model)
    protected $table = 'car_infos';

    // กำหนดฟิลด์ที่สามารถทำการบันทึกข้อมูลได้ (Mass Assignment)
    protected $fillable = [
        'user_id',
        'email',
        'license_plate',
        'province',
        'car_type',
    ];

    // ความสัมพันธ์ระหว่าง CarInfo กับ User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
