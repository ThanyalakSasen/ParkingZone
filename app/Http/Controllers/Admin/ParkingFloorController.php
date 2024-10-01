<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingFloor;

class ParkingFloorController extends Controller
{
    public function index()
    {
        $floors = ParkingFloor::all();
        return view('admin.parkingFloor', compact('floors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|numeric|unique:parking_floors,floor',
        ]);
        $parkingFloor = ParkingFloor::create($request->all());
        return redirect()->back()->with('success', 'Parking floor: "' . $parkingFloor->name . '" Create successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => 'required|numeric|unique:parking_floors,floor',
        ]);

        $parkingSpot = ParkingFloor::findOrFail($id);
        $parkingSpot->update($request->all());

        return redirect()->back()->with('success', 'Parking floor: "' . $parkingSpot->name . '" Update successfully!');
    }

    public function destroy($id)
    {
        ParkingFloor::destroy($id);
        return redirect()->back()->with('success', 'Deleted successfully!');
    }
}
