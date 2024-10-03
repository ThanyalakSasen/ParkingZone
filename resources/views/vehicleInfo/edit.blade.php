<!-- resources/views/car/edit.blade.php -->
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรถ</title>
    <link rel="stylesheet" href="{{ asset('uer-create-info.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
</head>

<body>
    
    <div class="sidebar">
        <div class="container">
            <!-- รูปภาพผู้ใช้อยู่ข้างบน -->
            <div class="profile-image-container">
                <div class="profile-image" id="profilePreview">
                    <img src="https://via.placeholder.com/120" alt="Profile Image">
                </div>
            </div>

            <ul>
                <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</a></li>
                <li><a href="{{ route('vehicle.index') }}"><i class="fas fa-car"></i> ข้อมูลรถของคุณ</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <h1>แก้ไขข้อมูลรถ</h1>
        <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="license_plate">เลขทะเบียนรถ</label>
            <input type="text" id="license_plate" name="license_plate" value="{{ $vehicle->license_plate }}"
                required>
            <br>

            <label for="province">เลือกจังหวัด</label>
            <select id="province" name="province" required>
                <option value="" disabled>เลือกจังหวัด</option>
                <option value="กรุงเทพมหานคร" {{ $vehicle->province == 'กรุงเทพมหานคร' ? 'selected' : '' }}>
                    กรุงเทพมหานคร
                </option>
                <option value="เชียงใหม่" {{ $vehicle->province == 'เชียงใหม่' ? 'selected' : '' }}>เชียงใหม่</option>
                <option value="เชียงราย" {{ $vehicle->province == 'เชียงราย' ? 'selected' : '' }}>เชียงราย</option>
            </select>
            <br>

            <label>เลือกประเภทรถ</label>
            <div>
                <input type="radio" id="car" name="vehicle_type" value="รถยนต์"
                    {{ $vehicle->vehicle_type == 'รถยนต์' ? 'checked' : '' }}> รถยนต์
                <input type="radio" id="motorcycle" name="vehicle_type" value="มอเตอร์ไซค์"
                    {{ $vehicle->vehicle_type == 'มอเตอร์ไซค์' ? 'checked' : '' }}> มอเตอร์ไซค์
            </div>
            <br>

            <button type="submit">บันทึกการแก้ไข</button>
        </form>
        <a href="{{ route('vehicle.index') }}">กลับไปหน้าข้อมูลรถ</a>
    </div>
</body>

</html>
