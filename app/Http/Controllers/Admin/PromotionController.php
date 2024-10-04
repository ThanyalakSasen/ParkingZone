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
        ]);

        $promotion = new Promotion();
        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->hourly_price = $validated['hourly_price'];
        $promotion->daily_price = $validated['daily_price'];
        $promotion->monthly_price = $validated['monthly_price'];

        $discount = $validated['discount_percentage'] / 100;
        $promotion->hourly_discounted = $promotion->hourly_price * (1 - $discount);
        $promotion->daily_discounted = $promotion->daily_price * (1 - $discount);
        $promotion->monthly_discounted = $promotion->monthly_price * (1 - $discount);
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
        ]);

        // Find promotion and update
        $promotion = Promotion::findOrFail($id);
        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::destroy($id);
        return redirect()->back()->with('success', 'Promotion deleted successfully!');
    }
}
