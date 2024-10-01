<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\VehicleInfo;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboards = Dashboard::all();
        $vehicleInfos = VehicleInfo::all();
        return view('dashboard', compact('dashboards', 'vehicleInfos'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'shipping_type' => 'required|string|in:hourly,day,monthly',
            'vehicle_type' => 'required|string|in:รถยนต์,มอเตอร์ไซต์',
            'license_plate1' => 'required_if:vehicle_type,รถยนต์',
            'license_plate2' => 'required_if:vehicle_type,มอเตอร์ไซต์',
            'date_entry' => 'required|date',
            'duration' => 'required|integer|min:1',
        ]);

        $shippingType = $validated['shipping_type'];
        $dateEntry = $validated['date_entry'];
        $duration = $validated['duration'];
        
        // ตรวจสอบหมายเลขทะเบียน
        $licensePlate = $validated['vehicle_type'] === 'รถยนต์' 
            ? $validated['license_plate1'] 
            : $validated['license_plate2'];

        if (empty($licensePlate)) {
            return redirect()->back()->withErrors(['error' => 'กรุณากรอกหมายเลขทะเบียนรถ']);
        }

        // คำนวณ date_exit
        $dateExit = $this->calculateDateExit($shippingType, $dateEntry, $duration);

        if (is_null($dateExit)) {
            return redirect()->back()->withErrors(['error' => 'ไม่สามารถคำนวณวันที่สิ้นสุดได้']);
        }

        // บันทึกลงในฐานข้อมูล
        Dashboard::create([
            'shipping_type' => $shippingType,
            'vehicle_type' => $validated['vehicle_type'],
            'license_plate' => $licensePlate,
            'date_entry' => $dateEntry,
            'date_exit' => $dateExit,
            'duration' => $duration,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'สำเร็จแล้ว.'); //Route ระบุชื่อrouteที่กำหนดในname
    }

    private function calculateDateExit($shippingType, $dateEntry, $duration)
    {
        $dateEntry = Carbon::parse($dateEntry);
        $duration = (int) $duration;

        switch ($shippingType) {
            case 'hourly':
                return $dateEntry->addHours($duration)->toDateTimeString();
            case 'day':
                return $dateEntry->addDays($duration)->toDateTimeString();
            case 'monthly':
                return $dateEntry->addMonths($duration)->toDateTimeString();
            default:
                return null;
        }
    }
}
