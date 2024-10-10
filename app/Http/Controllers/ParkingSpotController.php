<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ParkingSpotService;
use App\Models\ParkingFloor;
use App\Models\ParkingSpot;

class ParkingSpotController extends Controller
{
    public function show($id)
{
    $parkingSpot = ParkingSpot::find($id);
    
    if (!$parkingSpot) {
        return redirect()->route('reservations.index')->withErrors(['errors' => 'ไม่พบข้อมูลที่จอดรถ']);
    }

    return view('parking-spot.show', compact('parkingSpot'));
}


    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'dashboard_id' => 'required|numeric',
        ]);

        $dashboardId = $validate['dashboard_id'];
        session([
            'spotId' => $id,
            'dashboardId' => $dashboardId,
        ]);
        return redirect()->route('payment.index');
    }
}
