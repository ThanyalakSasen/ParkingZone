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
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        # comment บรรทัดนี้ ถ้าใช่ validate field พวกนี้
        $request->request->add([
            'monthly_price' => 0,
            'monthly_discounted' => 0,
        ]);

        $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_price' => 'required|numeric',
            'daily_price' => 'required|numeric',
            // 'monthly_price' => 'required|numeric',
            'hourly_discounted' => 'required|numeric',
            'daily_discounted' => 'required|numeric',
            // 'monthly_discounted' => 'required|numeric',
        ]);

        $promotion = Promotion::create($request->all());

        return redirect()->back()->with('success', 'Promotion "' . $promotion->festival_name . '" saved successfully!');
    }

    public function update(Request $request, $id)
    {
        # comment บรรทัดนี้ ถ้าใช่ validate field พวกนี้
        $request->request->add([
            'monthly_price' => 0,
            'monthly_discounted' => 0,
        ]);

        $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_price' => 'required|numeric',
            'daily_price' => 'required|numeric',
            // 'monthly_price' => 'required|numeric',
            'hourly_discounted' => 'required|numeric',
            'daily_discounted' => 'required|numeric',
            // 'monthly_discounted' => 'required|numeric',
        ]);

        // Find promotion and update
        $promotion = Promotion::findOrFail($id);
        $promotion->update($request->all());

        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::destroy($id);
        return redirect()->back()->with('success', 'Promotion deleted successfully!');
    }
}
