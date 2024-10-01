<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrakingStatusController extends Controller
{
    //
    public function index(Request $request)
    {
        $floor = $request->query('floor', 1); // ดึงค่าชั้นจาก query
        $parkings = Parking::where('floor', $floor)->get(); // ดึงข้อมูลที่จอดรถตามชั้นที่เลือก
    
        // นับจำนวนที่ว่างและไม่ว่าง
        $availableCount = $parkings->where('status', 'available')->count();
        $unavailableCount = $parkings->where('status', 'unavailable')->count();
    
        // ตรวจสอบว่าการร้องขอเป็น AJAX หรือไม่
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.parking_slots', compact('parkings'))->render(),
                'availableCount' => $availableCount,
                'unavailableCount' => $unavailableCount,
            ]);
        }
    
        return view('parking', compact('parkings', 'availableCount', 'unavailableCount'));
    }
    

    public function bookparking($id)
    {
        $parking = Parking::findOrFail($id); // Find the parking by ID

        if ($parking->status == 'available') {
            $parking->status = 'unavailable'; // Change status to 'unavailable' if available
        } else {
            return redirect()->back()->with('error', 'This parking slot is not available.');
        }

        $parking->save(); // Save the new status to the database

        return redirect()->back()->with('success', 'Parking slot booked successfully.');
    }
}
