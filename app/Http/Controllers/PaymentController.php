<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('payment');
    }

    public function create(Request $request)
    {
        return "ชำระเงินเสร็จสิ้นสำหรับ: " . $request->input('email') . " จำนวนเงิน: " . $request->input('total_amount');
    }
}
