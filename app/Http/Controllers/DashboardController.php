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
        dd('hhhererer 1', $request->all());
        $request->validate([
            'shipping_type' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'vehicle_info' => 'required|string',
            'date_entry' => 'required|date',
            'duration' => 'required|numeric',
        ]);

        dd('hhhererer');

        Dashboard::create([
            'shipping_type' => $request->input('shipping_type'),
            'vehicle_type' => $request->input('vehicle_type'),
            'license_plate' => $request->input('vehicle_info'),
            'date_entry' => $request->input('date_entry'),
            'date_exit' => $request->input('date_exit'),
            'duration' => $request->input('duration'),
        ]);

        # ควรส่งไปที่ view parkingSpot
        return view('parkingSpot', compact('dashboards', 'vehicleInfos'));
        // return redirect()->route('dashboard')->with('success', 'สร้างรายการใน Dashboard สำเร็จแล้ว.');
    }
}
