<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingFloor;
use App\Models\ParkingSpot;

class ParkingSpotController extends Controller
{
    public function index()
    {
        $floors = ParkingFloor::with('parkingSpots')->orderBy('floor', 'DESC')->get();
        $floors = $this->transformFloors($floors);
        return view('admin.parkingSpot', compact('floors'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'spot_number' => 'required|string|max:255',
            'floor_id' => 'required|numeric',
            'is_available' => 'required|numeric',
            'spot_type' => 'required|string',
        ]);

        $parkingSpot = ParkingSpot::create([
            'spot_number' => $validate['spot_number'],
            'parking_floor_id' => $validate['floor_id'],
            'is_available' => (bool) $validate['is_available'],
            'spot_type' => $validate['spot_type'],
        ]);

        return redirect()->back()->with('success', 'Parking spot "' . $parkingSpot->name . '"Create successfully!');
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'spot_number' => 'required|string|max:255',
            'floor_id' => 'required|numeric',
            'is_available' => 'required|numeric',
            'spot_type' => 'required|string',
        ]);

        $parkingSpot = ParkingSpot::findOrFail($id);
        $parkingSpot->update([
            'spot_number' => $validate['spot_number'],
            'parking_floor_id' => $validate['floor_id'],
            'is_available' => (bool) $validate['is_available'],
            'spot_type' => $validate['spot_type'],
        ]);

        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function destroy($id)
    {
        ParkingSpot::destroy($id);
        return redirect()->back()->with('success', 'Delete successfully!');
    }

    private function transformFloors($floors)
    {
        $result = [];
        foreach ($floors as $floor) {
            $floorData = [
                'id' => $floor->id,
                'name' => $floor->name,
                'floor' => $floor->floor,
                'spots' => $this->transfromSpot($floor->parkingSpots),
            ];
            $result[] = $floorData;
        }
        return $result;
    }

    public function transfromSpot($spots)
    {
        $data = [];
        foreach ($spots as $spot) {
            $data[] = [
                'id' => $spot->id,
                'spot_number' => $spot->spot_number,
                'is_available' => $spot->is_available,
                'spot_type' => $spot->spot_type,
            ];
        }
        return $data;
    }
}
