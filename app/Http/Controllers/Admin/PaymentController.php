<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('admin.payment');
    }

    public function store(Request $request)
    {
        return "ชำระเงินเสร็จสิ้นสำหรับ: " . $request->input('email') . " จำนวนเงิน: " . $request->input('total_amount');
    }
}
