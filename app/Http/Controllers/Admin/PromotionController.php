<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
{
    // ดึงข้อมูลโปรโมชันพร้อมการจองที่เกี่ยวข้อง
    $promotions = Promotion::with('reservations')->get();

    return view('admin.promotion', compact('promotions'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'vehicle_type' => 'required|string|in:car,motorcycle',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        // สร้าง promotion ใหม่และบันทึกข้อมูล
        $promotion = new Promotion();
        $promotion->festival_name = $validated['festival_name'];
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->vehicle_type = $validated['vehicle_type']; // บันทึกประเภทของยานพาหนะ

        // คำนวณราคาเต็มรายชั่วโมงและรายวันตามประเภทของยานพาหนะ
        if ($promotion->vehicle_type === 'car') {
            $promotion->hourly_price = 40;
            $promotion->daily_price = 200;
        } else {
            $promotion->hourly_price = 20;
            $promotion->daily_price = 100;
        }

        // คำนวณส่วนลดสำหรับราคาเต็มรายชั่วโมงและรายวัน
        $discount = $validated['discount_percentage'] / 100;
        $promotion->hourly_discounted = $promotion->hourly_price * (1 - $discount);
        $promotion->daily_discounted = $promotion->daily_price * (1 - $discount);

        $promotion->save();

        return redirect()->back()->with('success', 'Promotion "' . $promotion->festival_name . '" saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'vehicle_type' => 'required|string|in:car,motorcycle',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        // ค้นหา promotion ที่ต้องการแก้ไข
        $promotion = Promotion::findOrFail($id);

        // อัปเดตข้อมูล
        $promotion->festival_name = $request->input('festival_name');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');
        $promotion->vehicle_type = $request->input('vehicle_type'); // อัปเดตประเภทของยานพาหนะ

        // คำนวณราคาเต็มรายชั่วโมงและรายวันตามประเภทของยานพาหนะ
        if ($promotion->vehicle_type === 'car') {
            $promotion->hourly_price = 40;
            $promotion->daily_price = 200;
        } else {
            $promotion->hourly_price = 20;
            $promotion->daily_price = 100;
        }

        // คำนวณส่วนลดสำหรับราคาเต็มรายชั่วโมงและรายวัน
        $promotion->hourly_discounted = $promotion->hourly_price * (1 - $request->input('discount_percentage') / 100);
        $promotion->daily_discounted = $promotion->daily_price * (1 - $request->input('discount_percentage') / 100);

        $promotion->save();

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        if ($promotion) {
            $promotion->delete(); // Perform soft delete
            return redirect()->back()->with('success', 'Promotion deleted successfully.');
        }

        return redirect()->back()->with('error', 'Promotion not found.');
    }
}
