<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParkingSpotController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/board', function () {
    return view('board');
})->name('board');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard', [DashboardController::class, 'create'])->name('dashboard.create');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payments', [PaymentController::class, 'create'])->name('payment.create');

    Route::get('/parking-spots/{id}', [ParkingSpotController::class, 'show'])->name('user-parking-spots.show');
    Route::patch('/select-parking-spots/{id}', [ParkingSpotController::class, 'update'])->name('user-parking-spots.update');
});

require __DIR__ . '/auth.php';

# ส่วนของ admin จะอยู่ในไฟล์ admin.php
require __DIR__ . '/admin.php';
