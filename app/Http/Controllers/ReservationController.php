<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        // ดึงข้อมูลการจองพร้อมกับข้อมูล ParkingSpot และ Dashboard
        $reservations = Reservation::with(['parkingSpot', 'dashboard'])
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $latestReservation = Reservation::with(['parkingSpot', 'dashboard'])
            ->where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->orderBy('time_start', 'desc')
            ->first();

        return view('reservation', compact('reservations', 'latestReservation', 'user'));
    }

    public function cancelBooking(Request $request, $id){
        $reservation = Reservation::find($id); // ค้นหาการจองที่ต้องการยกเลิก
        $reservation->parking_status = 'cancelled'; // เปลี่ยนสถานะเป็น 'cancelled'
        $reservation->save();

        
    // ส่งผู้ใช้กลับไปยังหน้าที่ต้องการพร้อมข้อความแจ้งเตือน
    return redirect()->route('reservations.index')->with('success', 'การจองถูกยกเลิกเรียบร้อยแล้ว!');
    }

}