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
        $reservations = Reservation::where('user_id', $user->id)
            ->get();
        $latestReservation = Reservation::where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->first();

        return view('reservation', compact('reservations', 'latestReservation', 'user'));
    }
}
