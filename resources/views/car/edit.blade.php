<!-- resources/views/car/edit.blade.php -->
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรถ</title>
    <link rel="stylesheet" href="{{ asset('carinfo.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
</head>
<body>

<div class="main-content">

    <h1>แก้ไขข้อมูลรถ</h1>
    <form action="{{ route('car.update', $car->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="license_plate">เลขทะเบียนรถ</label>
        <input type="text" id="license_plate" name="license_plate" value="{{ $car->license_plate }}" required>
        <br>

        <label for="province">เลือกจังหวัด</label>
        <select id="province" name="province" required>
            <option value="" disabled>เลือกจังหวัด</option>
            <option value="กรุงเทพมหานคร" {{ $car->province == 'กรุงเทพมหานคร' ? 'selected' : '' }}>กรุงเทพมหานคร</option>
            <option value="เชียงใหม่" {{ $car->province == 'เชียงใหม่' ? 'selected' : '' }}>เชียงใหม่</option>
            <option value="เชียงราย" {{ $car->province == 'เชียงราย' ? 'selected' : '' }}>เชียงราย</option>
        </select>
        <br>

        <label>เลือกประเภทรถ</label>
        <div>
            <input type="radio" id="car" name="car_type" value="รถยนต์" {{ $car->car_type == 'รถยนต์' ? 'checked' : '' }}> รถยนต์
            <input type="radio" id="motorcycle" name="car_type" value="มอเตอร์ไซค์" {{ $car->car_type == 'มอเตอร์ไซค์' ? 'checked' : '' }}> มอเตอร์ไซค์
        </div>
        <br>

        <button type="submit">บันทึกการแก้ไข</button>
    </form>
    <a href="{{ route('car.index') }}">กลับไปหน้าข้อมูลรถ</a>
</body>
</html>

