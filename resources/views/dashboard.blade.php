<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <title>จองที่จอดรถ</title>

    <script>
        function showForm(type) {
            const inputHourly = document.getElementById('hourly');
            const inputDayly = document.getElementById('dayly');
            const inputMonthly = document.getElementById('monthly');

            const label = document.getElementById('duration-label');
            const inputLabel = document.getElementById('duration-input');

            if (inputHourly.checked) {
                label.innerText = 'จำนวนชั่วโมง:';
                inputLabel.min = 1;
                inputLabel.max = 23;
            } else if (inputDayly.checked) {
                label.innerText = 'จำนวนวัน:';
                inputLabel.min = 1;
                inputLabel.max = 30;
            } else {
                label.innerText = 'จำนวนเดือน:';
                inputLabel.min = 1;
                inputLabel.max = 12;
            }
        }

        function showVehicleForm(type) {
            const carForm = document.getElementById('carForm');
            const motorcycleForm = document.getElementById('motorcycleForm');

            if (type === 'รถยนต์') {
                carForm.style.display = 'block';
                motorcycleForm.style.display = 'none';
            } else if (type === 'มอเตอร์ไซต์') {
                motorcycleForm.style.display = 'block';
                carForm.style.display = 'none';
            }
        }

        window.onload = function() {
            showForm('hourly');
        };
    </script>

    <style>
        form#login{
            display: flex;
        }
        form#login button{
            margin-left: 20px
        }
    </style>
</head>

<body>
    <header>
        <h3>ParkingZone</h3>
        
        <form id="login" method="POST" action="{{ route('logout') }}">
            @csrf
            <p>โปรไฟล์</p>
            <button type="submit">Logout</button>
        </form>
    </header>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('dashboard.create') }}" id="main">
        @csrf
        <h3>ค้นหาที่จอดรถ</h3>
        <div class="shippingType">
            <div>
                <input type="radio" id="hourly" name="shipping_type" value="hourly" checked
                    onchange="showForm('hourly')">
                <label for="hourly">รายชั่วโมง</label>
            </div>
            <div>
                <input type="radio" id="dayly" name="shipping_type" value="day" onchange="showForm('day')">
                <label for="day">รายวัน</label>
            </div>
            <div>
                <input type="radio" id="monthly" name="shipping_type" value="monthly"
                    onchange="showForm('monthly')">
                <label for="monthly">รายเดือน</label>
            </div>
        </div>

        <div class="vehicleType">
            <select name="vehicle_type" id="vehicleType" onchange="showVehicleForm(this.value)">
                <option value="">เลือกประเภท</option>
                <option value="รถยนต์">รถยนต์</option>
                <option value="มอเตอร์ไซต์">มอเตอร์ไซต์</option>
            </select>
        </div>
        <div id="carForm">
            <select name="vehicle_info">
                <option value="">เลือกหมายเลขทะเบียน</option>
                @foreach ($vehicleInfos as $vehicleInfo)
                    <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                @endforeach
            </select>
        </div>
        <div id="motorcycleForm">
            <select name="vehicle_info">
                <option value="">เลือกหมายเลขทะเบียน</option>
                @foreach ($vehicleInfos as $vehicleInfo)
                    <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="date_entry">วันที่เข้า:</label>
            <input type="datetime-local" name="date_entry" required>
        </div>
        <div>
            <label id='duration-label' for="duration"></label>
            <input id="duration-input" type="number" name="duration">
        </div>



        <button type="submit" id="subbtn">จอง</button>
    </form>

    {{-- <table>
        <thead>
            <tr>
                <th>ประเภทการจอง</th>
                <th>ประเภทของรถ</th>
                <th>หมายเลขทะเบียน</th>
                <th>วันที่เข้า</th>
                <th>วันที่ออก</th>
                <th>ระยะเวลา</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dashboards as $dashboard)
                <tr>
                    <td>{{ $dashboard->shipping_type }}</td>
                    <td>{{ $dashboard->vehicle_type }}</td>
                    <td>{{ $dashboard->license_plate }}</td>
                    <td>{{ $dashboard->date_entry->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $dashboard->date_exit->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $dashboard->duration }} ชั่วโมง</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</body>

</html>
