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
        'license_plate1' => 'required|string|max:10',
        'shipping_type' => 'required|string',
        'vehicle_type' => 'required|string',
        'date_entry' => 'required|date',
        'duration' => 'required|integer',
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

    // Create the dashboard entry and set user_id
    $dashboard = Dashboard::create([
        'user_id' => Auth::id(),
        'shipping_type' => $shippingType,
        'vehicle_type' => $validated['vehicle_type'],
        'license_plate' => $licensePlate,
        'date_entry' => $dateEntry,
        'date_exit' => $dateExit,
        'duration' => $duration,
    ]);if (!$dashboard) {
        return redirect()->back()->withErrors(['errors' => 'ไม่สามารถสร้างการจองได้']);
    }
    return redirect()->route('user-parking-spots.show', ['id' => $dashboard->dashboard_id]);
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

// DashboardController.php
