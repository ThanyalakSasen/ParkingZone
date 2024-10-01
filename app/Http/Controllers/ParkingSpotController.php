<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpot;
use Illuminate\Http\Request;

class ParkingSpotController extends Controller
{
    // แสดงที่จอดรถทั้งหมด
    public function index()
    {
        $parkingspots = ParkingSpot::all();
        return view('parkingspots.index', compact('parkingspots'));
    }

    // แสดงฟอร์มเพิ่มที่จอดรถ
    public function create()
    {
        return view('parkingspots.create');
    }

    // บันทึกที่จอดรถใหม่
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,unavailable',
        ]);

        ParkingSpot::create($request->all());
        return redirect()->route('parkingspots.index')->with('success', 'ที่จอดรถถูกเพิ่มเรียบร้อยแล้ว!');
    }

    // แสดงฟอร์มแก้ไขที่จอดรถ
    public function edit($id)
    {
        $parkingspot = ParkingSpot::findOrFail($id);
        return view('parkingspots.edit', compact('parkingspot'));
    }

    // อัปเดตที่จอดรถ
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,unavailable',
        ]);

        $parkingspot = ParkingSpot::findOrFail($id);
        $parkingspot->update($request->all());
        return redirect()->route('parkingspots.index')->with('success', 'ที่จอดรถถูกอัปเดตเรียบร้อยแล้ว!');
    }

    // ลบที่จอดรถ
    public function destroy($id)
    {
        $parkingspot = ParkingSpot::findOrFail($id);
        $parkingspot->delete();
        return redirect()->route('parkingspots.index')->with('success', 'ที่จอดรถถูกลบเรียบร้อยแล้ว!');
    }
}
