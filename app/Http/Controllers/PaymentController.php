<?php

namespace App\Http\Controllers;

use App\Models\Promotion; 
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        // ดึงข้อมูลโปรโมชั่นทั้งหมดจากฐานข้อมูล
        dd('here');
        $promotions = Promotion::all(); // หรือใช้ query อื่นๆ ตามที่คุณต้องการ

        // ส่งตัวแปร $promotions ไปยัง view
        return view('payment', compact('promotions'));
    }

    public function processPayment(Request $request)
    {
        // การประมวลผลการชำระเงิน
    }
}
