<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('user-dashboard.css') }}">
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
                carForm.style.display = 'none';
                motorcycleForm.style.display = 'block';
            }
        }

        window.onload = function() {
            showForm('hourly');
        };
    </script>
</head>

<body>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session('errors'))
        <div class="error">{{ session('errors') }}</div>
    @endif
    <header>
        <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
        <h3>ParkingZone</h3>
        <div class="navigation-wrap">
            <a href="{{ route('reservations.index') }}">ประวัติการจอง</a>
            <a href="{{ route('vehicle.create') }}">เพิ่มข้อมูลรถ</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    logout
                </button>
            </form>
        </div>
    </header>

    <form method="POST" action="{{ route('dashboard.create') }}" id="main">
        @csrf
        <h3>ค้นหาที่จอดรถ</h3>
        <div class="shippingType">
            <div>
                <input class="radio-wrap" type="radio" id="hourly" name="shipping_type" value="hourly" checked
                    onchange="showForm('hourly')">รายชั่วโมง</input>
            </div>
            <div>
                <input class="radio-wrap" type="radio" id="dayly" name="shipping_type" value="dayly"
                    onchange="showForm('day')">รายวัน</input>
            </div>
            <div>
                <input class="radio-wrap" type="radio" id="monthly" name="shipping_type" value="monthly"
                    onchange="showForm('monthly')">รายเดือน</input>
            </div>
        </div>

        <div class="dropdow-wrap">
            <label for="vehicle_type">เลือกประเภทรถ</label>
            <select class="dropdown-select" name="vehicle_type" id="vehicle_type"
                onchange="showVehicleForm(this.value)">
                <option value="รถยนต์">รถยนต์</option>
                <option value="มอเตอร์ไซต์">มอเตอร์ไซต์</option>
            </select>
        </div>
        <div id="carForm" class="dropdow-wrap">
            <label for="license_plate1">เลือกหมายเลขทะเบียน</label>
            <select class="dropdown-select" name="license_plate1">
                <option value="1กว 6649">1กว 6649</option>
                @foreach ($vehicleInfos as $vehicleInfo)
                    @if ($vehicleInfo->vehicle_type == 'รถยนต์')
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div id="motorcycleForm" class="dropdow-wrap">
            <label for="license_plate1">เลือกหมายเลขทะเบียน</label>
            <select class="dropdown-select" name="license_plate2">
                <option value="ขม 214">ขม 214</option>
                @foreach ($vehicleInfos as $vehicleInfo)
                    @if ($vehicleInfo->vehicle_type == 'มอเตอร์ไซต์')
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="dropdow-wrap">
            <label for="date_entry">วันที่เข้า:</label>
            <input class="input-date-time" type="datetime-local" name="date_entry" required>
        </div>
        <div class="dropdow-wrap">
            <label id='duration-label' for="duration"></label>
            <input class="input-duration" id="duration-input" type="number" name="duration" value="1" required>
        </div>

        <button type="submit" id="subbtn">จอง</button>
    </form>
</body>

</html>
