<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลรถของคุณ</title>
    <link rel="stylesheet" href="{{ asset('user-vehicle.css') }}">
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

            <p>{{ $user->email }}</p>

            <ul>
                <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</a></li>
                <li><a href="{{ route('vehicle.index') }}"><i class="fas fa-car"></i> ข้อมูลรถของคุณ</a></li>
            </ul>
        </div>
    </div>


    <div class="main-content">
        <h1>ข้อมูลรถของคุณ</h1>
        <button class="btn" id="addCarBtn" onclick="goToFormPage()"><a
                href="{{ route('vehicle.create') }}">เพิ่มรถใหม่</a></button>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>เลขทะเบียน</th>
                    <th>จังหวัด</th>
                    <th>ประเภทรถ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $index => $vehicle)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $vehicle->license_plate }}</td>
                        <td>{{ $vehicle->province }}</td>
                        <td>{{ $vehicle->vehicle_type }}</td>
                        <td>
                            <a href="{{ route('vehicle.edit', $vehicle->id) }}">แก้ไข</a>
                            <form method="POST" action="{{ route('vehicle.delete', $vehicle->id) }}"
                                style="display:inline;" onsubmit="return confirm('คุณต้องการลบรถคันนี้หรือไม่?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">ลบ</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


</body>

</html>
