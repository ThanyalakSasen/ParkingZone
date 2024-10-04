<?php

namespace App\Http\Controllers;

use App\Models\CarInfo;
use App\Models\VehicleInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleInfoController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $vehicles = VehicleInfo::where('user_id', $user->id)->get();
        return view('vehicleInfo.index', compact('vehicles', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('vehicleInfo.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            
            'license_plate' => 'required|string|max:10|unique:vehicle_infos,license_plate',
            'province' => 'required|string|max:50',
            'vehicle_type' => 'required|in:รถยนต์,มอเตอร์ไซค์',
        ]);

        $user = Auth::user();
        VehicleInfo::create([
            'user_id' => $user->id,
            'license_plate' => $validated['license_plate'],
            'province' => $validated['province'],
            'vehicle_type' => $validated['vehicle_type'],
        ]);

        return redirect()->route('vehicle.index')->with('success', 'เพิ่มข้อมูลรถเรียบร้อยแล้ว!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $vehicle = VehicleInfo::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        return view('vehicleInfo.edit', compact('vehicle'));
    }

    // ฟังก์ชันบันทึกการแก้ไขข้อมูลรถ
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:10',
            'province' => 'required|string|max:50',
            'vehicle_type' => 'required|in:รถยนต์,มอเตอร์ไซค์',
        ]);

        $user = Auth::user();
        $vehicle = VehicleInfo::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $vehicle->update($validated);

        return redirect()->route('vehicle.index')->with('success', 'ข้อมูลรถถูกแก้ไขเรียบร้อยแล้ว!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $vehicle = VehicleInfo::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $vehicle->delete();
        return redirect()->route('vehicle.index')->with('success', 'ลบข้อมูลรถเรียบร้อยแล้ว!');
    }
}
