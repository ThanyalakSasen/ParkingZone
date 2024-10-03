<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Customer;

class ReservationController extends Controller
{
    public function index(Request $request)
{
    // สมมติว่าเราดึงข้อมูลลูกค้าจากระบบหรือโมเดล Customer
    $customer = Customer::first(); // หากใช้ระบบ Authentication หรือ
    // $customer = Customer::find(1); // หรือดึงข้อมูลจากฐานข้อมูล

    $status = $request->query('status', 'สำเร็จ');
    $reservations = Reservation::where('parking_status', $status)->get();
    $latestReservation = Reservation::orderBy('booking_date', 'desc')
                                    ->orderBy('start_time', 'desc')
                                    ->first();

    return view('Reservation', compact('reservations', 'latestReservation', 'customer'));
}


public function show($id)
{
    $reservation = Reservation::find($id);
    return view('Reservation', compact('reservation'));
}
}
