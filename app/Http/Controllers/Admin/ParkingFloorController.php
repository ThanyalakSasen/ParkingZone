<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParkingFloor;
use Illuminate\Validation\Rule;

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
            'floor' => [
                'required',
                'numeric',
                Rule::unique('parking_floors', 'floor'),
                Rule::unique('parking_floors')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name);
                }),
            ],
        ]);
        $parkingFloor = ParkingFloor::create($request->all());
        return redirect()->back()->with('success', 'Parking floor: "' . $parkingFloor->name . '" Create successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'floor' => [
                'required',
                'numeric',
                Rule::unique('parking_floors', 'floor')->ignore($id),
                Rule::unique('parking_floors')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name);
                })->ignore($id),
            ],
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
