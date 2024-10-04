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
        $status = $request->query('status', 'สำเร็จ');
        $reservations = Reservation::where('parking_status', $status)
            ->where('user_id', $user->id)
            ->get();
        $latestReservation = Reservation::where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->first();

        return view('Reservation', compact('reservations', 'latestReservation', 'user'));
    }


    public function show($id)
    {
        $reservation = Reservation::find($id);
        return view('Reservation', compact('reservation'));
    }
}
