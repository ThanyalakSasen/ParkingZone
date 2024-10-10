<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\ParkingSpot;
use App\Models\Reservation;
use App\Models\Payments; // Make sure the correct model is imported
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
{
    // กำหนดราคาที่จอดรถ
    $prices = [
        'car' => [
            'hourly' => 40,
            'daily' => 200,
            'monthly' => 6000,
        ],
        'motorcycle' => [
            'hourly' => 20,
            'daily' => 100,
            'monthly' => 3000,
        ],
    ];

    // Fetch promotions, spot information, etc., to show on the payment page
    $spotId = session('spot_id'); // Or however you retrieve the spot ID
    $dashboardId = session('dashboard_id'); // Retrieve dashboard ID similarly
    $shippingType = session('shipping_type'); // Get shipping type
    $duration = session('duration'); // Get duration

    // ดึงข้อมูลจาก Dashboard โดยเชื่อมโยงกับ user_id
    $dashboard = Dashboard::where('user_id', auth()->id())->first();

    // ตรวจสอบว่า $dashboard มีค่า
    if (!$dashboard) {
        // จัดการกับกรณีที่ไม่พบข้อมูล
        return redirect()->route('some.route')->with('error', 'ไม่พบข้อมูลการจอง');
    }

    // คำนวณ totalPrice
    $totalPrice = isset($prices[$dashboard->vehicle_type][$shippingType]) 
        ? $prices[$dashboard->vehicle_type][$shippingType] * $duration 
        : 0; // กำหนดราคาเป็น 0 หากไม่มีประเภท

    // ดึงข้อมูลโปรโมชัน
    $promotions = Promotion::all();

    return view('payment', compact('promotions', 'spotId', 'dashboardId', 'shippingType', 'duration', 'totalPrice', 'dashboard', 'prices'));

}

    
    public function create(Request $request)
    {
        // Debugging: Log incoming request data
        Log::info('Incoming Payment Request:', $request->all());

        // Validate input
        $request->validate([
            'payment_slip' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'spot_id' => 'required',
            'dashboard_id' => 'required',
            'price' => 'required|numeric',
        ]);

        try {
            // Retrieve the dashboard entry
            $dashboard = Dashboard::where('id', $request->dashboard_id)
                                  ->where('user_id', auth()->id()) // ตรวจสอบ user_id
                                ->firstOrFail();

            // Calculate the price based on the dashboard information
            $price = $this->calculatePrice($dashboard->shipping_type, $dashboard->vehicle_type, $dashboard->duration);

            // Process the payment (add your payment processing logic here)

            // Assuming you save the payment slip
            $paymentSlip = $request->file('payment_slip')->store('payment_slips'); // Store the payment slip

            // Create a new reservation
            $reservation = new Reservation();
            $reservation->spot_id = $request->input('spot_id');
            $reservation->dashboard_id = $dashboard->id; // Use the dashboard ID retrieved
            $reservation->price = $price; // Use calculated price
            $reservation->payment_slip = $paymentSlip;
            $reservation->save();

            // Fetch the parking spot details
            $parkingSpot = ParkingSpot::find($request->input('spot_id'));
            $reserveType = $dashboard->shipping_type; // Get shipping type or reservation type

            return view('paymentSuccess', compact('reservation', 'reserveType', 'parkingSpot'));
        } catch (\Exception $e) {
            // Log the error
            Log::error('Payment Error: ' . $e->getMessage());

            // Redirect back with an error message
            return back()->withErrors(['payment' => 'There was a problem processing your payment: ' . $e->getMessage()]);
        }
    }

    public function showPrices()
    {
        // กำหนดราคาที่จอดรถ
        $prices = [
            'car' => [
                'hourly' => 40,
                'daily' => 200,
                'monthly' => 6000,
            ],
            'motorcycle' => [
                'hourly' => 20,
                'daily' => 100,
                'monthly' => 3000,
            ],
        ];

        return view('payment', compact('prices'));
    }

    private function calculatePrice($shippingType, $vehicleType, $duration)
    {
        $prices = [
            'car' => [
                'hourly' => 40,
                'daily' => 200,
                'monthly' => 6000,
            ],
            'motorcycle' => [
                'hourly' => 20,
                'daily' => 100,
                'monthly' => 3000,
            ],
        ];

        switch ($shippingType) {
            case 'hourly':
                return $prices[$vehicleType]['hourly'] * $duration;
            case 'daily':
                return $prices[$vehicleType]['daily'] * $duration;
            case 'monthly':
                return $prices[$vehicleType]['monthly'] * $duration;
            default:
                throw new \Exception("Invalid shipping type");
        }
    }
}
