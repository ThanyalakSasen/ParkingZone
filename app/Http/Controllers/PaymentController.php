<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index($dashboardId): View
    {

        return view('payment',compact('dashboardId'));
    }

    public function create(Request $request)
    {
        $user = Auth::user(); 
        //สร้างreservation  
        // 'dashboard_id',
        // 'user_id',
        // 'booking_date',
        // 'start_time',
        // 'end_time',
        // 'reservation_number',
        // 'parking_type',
        // 'license_plate',
        // 'parking_status',
        // 'price',

        // 'shipping_type',
        // 'vehicle_type',
        // 'license_plate',
        // 'date_entry',
        // 'date_exit',
        // 'duration',
        return "ชำระเงินเสร็จสิ้นสำหรับ: " . $request->input('email') . " จำนวนเงิน: " . $request->input('total_amount');
    }
}
