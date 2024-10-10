<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'spot_id',
        'dashboard_id',
        'promotion_id', // เพิ่ม promotion_id ในฟิลด์ที่สามารถกรอกข้อมูลได้
        'price',
        'payment_slip',
    ];

    // ความสัมพันธ์ Many-to-One กับ Promotion
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);  // การชำระเงินนี้อาจมีโปรโมชันที่เกี่ยวข้อง
    }
}
