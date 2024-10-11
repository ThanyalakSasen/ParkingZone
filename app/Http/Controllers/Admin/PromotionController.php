<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotion', compact('promotions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_price' => 'required|numeric',
            'daily_price' => 'required|numeric',
            'monthly_price' => 'required|numeric',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'vehicle_type' => 'required|string|in:รถยนต์,มอเตอร์ไซต์',
        ]);

        $discount = $validated['discount_percentage'] / 100;
        $hourlyPrice =  $validated['hourly_price'] * (1 - $discount);
        $daylyPrice =  $validated['daily_price']  * (1 - $discount);
        $monthlyPrice =  $validated['monthly_price']  * (1 - $discount);

        $promotion = new Promotion();
        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->hourly_price = $hourlyPrice;
        $promotion->daily_price = $daylyPrice;
        $promotion->monthly_price = $monthlyPrice;
        $promotion->discount_percentage = $validated['discount_percentage'];
        $promotion->vehicle_type = $validated['vehicle_type'];
        $promotion->save();

        return redirect()->back()->with('success', 'Promotion "' . $promotion->festival_name . '" saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_price' => 'required|numeric',
            'daily_price' => 'required|numeric',
            'monthly_price' => 'required|numeric',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'vehicle_type' => 'required|string|in:รถยนต์,มอเตอร์ไซต์',
        ]);

        $promotion = Promotion::findOrFail($id);
        $discount = $validated['discount_percentage'] / 100;
        $hourlyPrice =  $validated['hourly_price'] * (1 - $discount);
        $daylyPrice =  $validated['daily_price']  * (1 - $discount);
        $monthlyPrice =  $validated['monthly_price']  * (1 - $discount);

        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->hourly_price = $hourlyPrice;
        $promotion->daily_price = $daylyPrice;
        $promotion->monthly_price = $monthlyPrice;
        $promotion->discount_percentage = $validated['discount_percentage'];
        $promotion->vehicle_type = $validated['vehicle_type'];
        $promotion->update();

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::destroy($id);
        return redirect()->back()->with('success', 'Promotion deleted successfully!');
    }
}
