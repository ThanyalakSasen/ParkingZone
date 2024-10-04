<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลรถของคุณ</title>
    <link rel="stylesheet" href="{{ asset('user-vehicle.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
    <style>
        .main-content a {
            color: black;
            margin-right: 15px;
        }

        .btn a {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            color: white;
        }

        ul li button {
            background-color: #000048;
            border: 1px solid #000048;
            color: white;
            font-size: 18px;

        }

        ul li button:hover {
            background-color: white;
            border: 1px solid white;
            color: #000048;
        }
    </style>

</head>

<body>
    {{-- @if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif
@if (session('errors'))
    <div class="error">{{ session('errors') }}</div>
@endif --}}


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
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>


    <div class="main-content">
        <h1>ข้อมูลรถของคุณ</h1>
        <button class="btn" id="addCarBtn" onclick="checkCarLimit(event, {{ $vehicles->count() }})"><a
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
    </div>

    <script>
        // ฟังก์ชันตรวจสอบจำนวนรถก่อนการเพิ่มใหม่
        function checkCarLimit(event, carCount) {
            if (carCount >= 4) {
                // แสดง alert เตือนว่าจำนวนรถเกินแล้ว
                alert('คุณไม่สามารถเพิ่มรถได้เกิน 4 คัน');
                event.preventDefault(); // ป้องกันการคลิกเข้าไปในลิงก์
                return false; // หยุดการทำงานของลิงก์
            }
            return true; // ถ้าไม่เกิน 4 คัน ให้ไปต่อ
        }
    </script>

</body>

</html>
