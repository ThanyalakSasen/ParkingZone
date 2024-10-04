<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ParkingSpotService;
use App\Models\ParkingFloor;
use App\Models\ParkingSpot;

class ParkingSpotController extends Controller
{
    public function show($dashboardId)
    {
        $floors = ParkingFloor::with('parkingSpots')->orderBy('floor', 'DESC')->get();
        $floors = (new ParkingSpotService())->transformFloors($floors);
        return view('parkingSpot', compact('floors', 'dashboardId'));
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
