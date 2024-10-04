@extends('layouts.sidebar')

@section('title', 'แก้ไขข้อมูลรถ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('user-vehicle-edit.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>แก้ไขข้อมูลรถ</h1>
        <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-wrap">
                <label for="license_plate">เลขทะเบียนรถ</label>
                <input type="text" id="license_plate" name="license_plate" value="{{ $vehicle->license_plate }}" required>
            </div>

            <div class="input-wrap">
                <label for="province">เลือกจังหวัด</label>
                <select id="province" name="province" required>
                    <option value="" disabled>เลือกจังหวัด</option>
                    <option value="กรุงเทพมหานคร" {{ $vehicle->province == 'กรุงเทพมหานคร' ? 'selected' : '' }}>
                        กรุงเทพมหานคร
                    </option>
                    <option value="เชียงใหม่" {{ $vehicle->province == 'เชียงใหม่' ? 'selected' : '' }}>เชียงใหม่</option>
                    <option value="เชียงราย" {{ $vehicle->province == 'เชียงราย' ? 'selected' : '' }}>เชียงราย</option>
                </select>
            </div>

            <div class="input-wrap">
                <label>เลือกประเภทรถ</label>
                <div>
                    <input type="radio" id="car" name="vehicle_type" value="รถยนต์"
                        {{ $vehicle->vehicle_type == 'รถยนต์' ? 'checked' : '' }}> <span class="input-radio">รถยนต์</span>
                    <input type="radio" id="motorcycle" name="vehicle_type" value="มอเตอร์ไซต์"
                        {{ $vehicle->vehicle_type == 'มอเตอร์ไซต์' ? 'checked' : '' }}> <span
                        class="input-radio">มอเตอร์ไซต์</span>
                </div>
            </div>

            <button type="submit" class="button-submit">อัพเดตข้อมูล</button>
        </form>
    </div>
@endsection
