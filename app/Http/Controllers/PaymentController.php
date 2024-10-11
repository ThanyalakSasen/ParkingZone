<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\ParkingSpot;
use App\Models\Promotion;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(): View
    {
        $spotId = session('spotId');
        $dashboardId = session('dashboardId');
        $promotions = Promotion::all();

        $dashboard = Dashboard::where('id', $dashboardId)->first();
        $vehicleType = $dashboard->vehicle_type;
        $shippingType = $dashboard->shipping_type;
        $duration = $dashboard->duration;
        return view('payment', compact('spotId', 'dashboardId', 'promotions', 'shippingType', 'duration', 'vehicleType'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'spot_id' => 'required|numeric',
            'dashboard_id' => 'required|numeric',
            'price' => 'required|numeric',
            'discount_percentage' => 'equired|numeric',
        ]);

        $user = Auth::user();
        $dashboard = Dashboard::where('id', $validated['dashboard_id'])->first();
        $parkingSpot = ParkingSpot::findOrFail($validated['spot_id']);
        $parkingSpot->update([
            'is_available' => false,
        ]);

        $reservation =  Reservation::create([
            'dashboard_id' => $validated['dashboard_id'],
            'user_id' => $user->id,
            'booking_date' => Carbon::now()->format('Y-m-d\TH:i'),
            'time_start' => $dashboard->date_entry,
            'end_time' => $dashboard->date_exit,
            'spot_number' => $parkingSpot->spot_number,
            'parking_type' => $dashboard->shipping_type,
            'license_plate' => $dashboard->license_plate,
            'parking_status' => 'ไม่ว่าง',
            'price' => $validated['price'],
        ]);

        if ($dashboard->shipping_type == 'hourly') {
            $reserseType = 'รายชั่วโมง';
        } else if ($dashboard->shipping_type == 'dayly') {
            $reserseType = 'รายวัน';
        } else if ($dashboard->shipping_type == 'monthly') {
            $reserseType = 'รายเดือน';
        }

        return view('paymentSuccess', compact('reservation', 'reserseType', 'parkingSpot'));
    }
}
