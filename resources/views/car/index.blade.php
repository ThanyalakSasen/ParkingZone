
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('car.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
</head>
<body>

    <div class="main-content">
    <h1>ข้อมูลรถของคุณ</h1>
    <button class="btn" id="addCarBtn" onclick="goToFormPage()"><a href="{{ route('car.create') }}">เพิ่มรถใหม่</a></button>
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
        @foreach ($cars as $index => $car)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $car->license_plate }}</td>
                <td>{{ $car->province }}</td>
                <td>{{ $car->car_type }}</td>
                <td>
                    <a href="{{ route('car.edit', $car->id) }}">แก้ไข</a>
                    <form action="{{ route('car.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('คุณต้องการลบรถคันนี้หรือไม่?')">ลบ</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>