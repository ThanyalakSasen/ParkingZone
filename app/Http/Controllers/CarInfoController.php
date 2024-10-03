<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarInfo;

class CarInfoController extends Controller
{
    
    public function index()
    { 
        // ดึงข้อมูลรถที่เกี่ยวข้องกับผู้ใช้งานที่ล็อกอินอยู่ในขณะนั้น
        $cars = CarInfo::where('user_id', auth()->id())->get();
        $customer = auth()->user();
        return view('car.index', compact('cars', 'customer'));
    }
  
    public function create()
    {
        $customer = auth()->user();
        return view('car.create', compact('customer'));
     
    }

    // *****************แก้***************************

    // ฟังก์ชันบันทึกข้อมูลรถใหม่ลงในฐานข้อมูล
    public function store(Request $request)
{
    // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
    $validatedData = $request->validate([
        'license_plate' => 'required|string|max:10',
        'province' => 'required|string|max:50',
        'car_type' => 'required|in:รถยนต์,มอเตอร์ไซค์',
    ]);

    // บันทึกข้อมูลลงในตาราง car_infos พร้อมกับดึง email ของผู้ใช้ที่ล็อกอินอยู่
    CarInfo::create([
        'user_id' => auth()->id(),
        'license_plate' => $validatedData['license_plate'],
        'province' => $validatedData['province'],
        'car_type' => $validatedData['car_type'],
        'email' => auth()->user()->email, // เพิ่ม email ของผู้ใช้ที่ล็อกอินอยู่
    ]);

    // ส่งข้อความสำเร็จและเปลี่ยนเส้นทางไปยังหน้า car.index
    return redirect()->route('car.index')->with('success', 'เพิ่มข้อมูลรถเรียบร้อยแล้ว!');
}


    // ฟังก์ชันแสดงฟอร์มแก้ไขข้อมูลรถที่ต้องการแก้ไข
    public function edit($id)
{
    $car = CarInfo::where('id', $id)->where('user_id', auth()->id())->first();
    $customer = auth()->user(); // ดึงข้อมูลของผู้ใช้ที่ล็อกอินอยู่
    
    if (!$car) {
        return redirect()->route('car.index')->with('error', 'ไม่พบข้อมูลรถ');
    }

    return view('car.edit', compact('car', 'customer'));
}


    // ฟังก์ชันบันทึกการแก้ไขข้อมูลรถ
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลก่อนทำการบันทึกการแก้ไข
        $validatedData = $request->validate([
            'license_plate' => 'required|string|max:10',
            'province' => 'required|string|max:50',
            'car_type' => 'required|in:รถยนต์,มอเตอร์ไซค์',
        ]);

        // ตรวจสอบข้อมูลรถว่ามีในระบบและเป็นของผู้ใช้ปัจจุบันหรือไม่
        $car = CarInfo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // อัปเดตข้อมูลตามที่ validate แล้ว
        $car->update($validatedData);

        // ส่งข้อความสำเร็จและเปลี่ยนเส้นทางไปยังหน้า car.index
        return redirect()->route('car.index')->with('success', 'ข้อมูลรถถูกแก้ไขเรียบร้อยแล้ว!');
    }

    // ฟังก์ชันลบข้อมูลรถออกจากฐานข้อมูล
    public function destroy($id)
    {
        // ตรวจสอบข้อมูลรถว่ามีในระบบและเป็นของผู้ใช้ปัจจุบันหรือไม่
        $car = CarInfo::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // ลบข้อมูลรถ
        $car->delete();

        // ส่งข้อความสำเร็จและเปลี่ยนเส้นทางไปยังหน้า car.index
        return redirect()->route('car.index')->with('success', 'ลบข้อมูลรถเรียบร้อยแล้ว!');
    }

}
