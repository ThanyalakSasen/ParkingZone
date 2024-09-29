<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show(): View
    {
        return view('admin.dashboard');
    }
}
