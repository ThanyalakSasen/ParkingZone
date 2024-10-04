<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\VehicleInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dashboards = Dashboard::all();
        $vehicleInfos = VehicleInfo::where('user_id', $user->id)->get();
        if (count($vehicleInfos) == 0) {
            return redirect()->route('vehicle.create');
        }
        return view('dashboard', compact('dashboards', 'vehicleInfos'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'shipping_type' => 'required|string|in:hourly,dayly,monthly',
            'vehicle_type' => 'required|string|in:รถยนต์,มอเตอร์ไซต์',
            'license_plate1' => 'required_if:vehicle_type,รถยนต์',
            'license_plate2' => 'required_if:vehicle_type,มอเตอร์ไซต์',
            'date_entry' => 'required|date',
            'duration' => 'required|integer|min:1',
        ]);

        $shippingType = $validated['shipping_type'];
        $dateEntry = $validated['date_entry'];
        $duration = $validated['duration'];

        $licensePlate = $validated['vehicle_type'] === 'รถยนต์'
            ? $validated['license_plate1']
            : $validated['license_plate2'];

        if (empty($licensePlate)) {
            return redirect()->back()->withErrors(['errors' => 'กรุณากรอกหมายเลขทะเบียนรถ']);
        }

        $dateExit = $this->calculateDateExit($shippingType, $dateEntry, $duration);

        if (is_null($dateExit)) {
            return redirect()->back()->withErrors(['errors' => 'ไม่สามารถคำนวณวันที่สิ้นสุดได้']);
        }

        $dashboard = Dashboard::create([
            'shipping_type' => $shippingType,
            'vehicle_type' => $validated['vehicle_type'],
            'license_plate' => $licensePlate,
            'date_entry' => $dateEntry,
            'date_exit' => $dateExit,
            'duration' => $duration,
        ]);
        return redirect()->route('user-parking-spots.show', $dashboard->id);
    }

    private function calculateDateExit($shippingType, $dateEntry, $duration)
    {
        $dateEntry = Carbon::parse($dateEntry);
        $duration = (int) $duration;

        switch ($shippingType) {
            case 'hourly':
                return $dateEntry->addHours($duration)->format('Y-m-d\TH:i');
            case 'dayly':
                return $dateEntry->addDays($duration)->format('Y-m-d\TH:i');
            case 'monthly':
                return $dateEntry->addMonths($duration)->format('Y-m-d\TH:i');
            default:
                return null;
        }
    }
}
