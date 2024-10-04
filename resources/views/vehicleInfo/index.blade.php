@extends('layouts.sidebar')

@section('title', 'ข้อมูลรถของคุณ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('user-vehicle.css') }}">
@endpush

@section('content')
    <div class="container">
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
                            <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="editCar">แก้ไข</a>
                            <form method="POST" action="{{ route('vehicle.delete', $vehicle->id) }}" style="display:inline;"
                                onsubmit="return confirm('คุณต้องการลบรถคันนี้หรือไม่?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deleteCar">ลบ</button>
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
@endsection
