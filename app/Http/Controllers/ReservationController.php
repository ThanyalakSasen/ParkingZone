<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'สำเร็จ');
        $reservations = Reservation::where('parking_status', $status)->get();

        $latestReservation = Reservation::orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->first();
        return view('reservation', compact('reservations', 'latestReservation'));
    }

    public function show(Request $request, $id)
    {
        $status = $request->query('status', 'สำเร็จ');
        $reservations = Reservation::where('parking_status', $status)->get();

        # เข้าใจว่าจะเอาตัวที่เลือกในตารางมาแสดงใน latestReservation
        # ถ้าไม่ใช่ให้มาแก้ด้วย เพราะไม่เห็น .blade ของฟังก์ชั่น show นี้
        $latestReservation = Reservation::find($id);
        return view('reservation', compact('reservations', 'latestReservation'));
    }
}
