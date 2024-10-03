<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

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
        // Validate input
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_price' => 'required|numeric',
            'daily_price' => 'required|numeric',
            'monthly_price' => 'required|numeric',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        // Create new promotion
        $promotion = new Promotion();
        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->hourly_price = $validated['hourly_price'];
        $promotion->daily_price = $validated['daily_price'];
        $promotion->monthly_price = $validated['monthly_price'];
        
        // คำนวณราคาที่ลดแล้วตามเปอร์เซ็นต์ส่วนลด
        $discount = $validated['discount_percentage'] / 100;
        $promotion->hourly_discounted = $promotion->hourly_price * (1 - $discount);
        $promotion->daily_discounted = $promotion->daily_price * (1 - $discount);
        $promotion->monthly_discounted = $promotion->monthly_price * (1 - $discount);

        $promotion->save();

        // ส่ง response กลับมาในรูปแบบ JSON
        return response()->json([
            'success' => true,
            'promotion' => $promotion,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
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
        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->hourly_price = $validated['hourly_price'];
        $promotion->daily_price = $validated['daily_price'];
        $promotion->monthly_price = $validated['monthly_price'];
        
        // คำนวณราคาที่ลดแล้วตามเปอร์เซ็นต์ส่วนลด
        $discount = $validated['discount_percentage'] / 100;
        $promotion->hourly_discounted = $promotion->hourly_price * (1 - $discount);
        $promotion->daily_discounted = $promotion->daily_price * (1 - $discount);
        $promotion->monthly_discounted = $promotion->monthly_price * (1 - $discount);

        $promotion->save();

        // ส่ง response กลับมาในรูปแบบ JSON
        return response()->json([
            'success' => true,
            'promotion' => $promotion,
        ]);
    }

    public function destroy($id)
    {
        // ลบโปรโมชัน
        Promotion::destroy($id);

        // ส่ง response กลับมาในรูปแบบ JSON
        return response()->json(['success' => true]);
    }
}
