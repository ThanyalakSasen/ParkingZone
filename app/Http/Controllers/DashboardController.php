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

    # มีปัญหา กด submit ที่ form เเล้วเเล้วไม่ส่ง request มาที่ฟังก์ชั่นนี้
    # เดาว่า เขียนฟอร์มผิดปกติ
    # ให้ เอา validate เเล้วส่ง form post request เปล่าๆ มาลองก่อน
    public function create(Request $request)
    {
        $request->validate([
            'shipping_type' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_info' => 'required|string',
            'date_entry' => 'required|date',
            'date_exit' => 'required|date|after:date_entry',
        ]);

        $dateEntry = Carbon::parse($request->input('date_entry'));
        $dateExit = Carbon::parse($request->input('date_exit'));
        $duration = $dateExit->diffInHours($dateEntry);

        Dashboard::create([
            'shipping_type' => $request->input('shipping_type'),
            'vehicle_type' => $request->input('vehicle_type'),
            'license_plate' => $request->input('vehicle_info'),
            'date_entry' => $request->input('date_entry'),
            'date_exit' => $request->input('date_exit'),
            'duration' => $duration,
        ]);

        # ควรส่งไปที่ view parkingSpot
        return redirect()->route('dashboard')->with('success', 'สร้างรายการใน Dashboard สำเร็จแล้ว.');
    }
}
