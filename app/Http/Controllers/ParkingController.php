<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function showForm()
    {
        return view('form'); // สร้าง view ชื่อ 'form.blade.php'
    }
}
