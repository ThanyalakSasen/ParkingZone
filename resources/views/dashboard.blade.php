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
            const timeStart = document.getElementById('time-start');

            if (type === 'hourly') {
                inputHourly.checked = true;
                label.innerText = 'จำนวนชั่วโมง:';
                inputLabel.min = 1;
                inputLabel.max = 23;
                timeStart.style.display = 'block';

            } else if (type === 'dayly') {
                inputDayly.checked = true;
                label.innerText = 'จำนวนวัน:';
                inputLabel.min = 1;
                inputLabel.max = 30;
                timeStart.style.display = 'block';
            } else if (type === 'monthly') {
                inputMonthly.checked = true;
                label.innerText = 'จำนวนเดือน:';
                inputLabel.min = 1;
                inputLabel.max = 12;
                timeStart.style.display = 'none';
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
        <h3>จองที่จอด</h3>
        <div class="shippingType">
            <div>
                <input class="radio-wrap" type="radio" id="hourly" name="shipping_type" value="hourly" checked
                    onchange="showForm('hourly')"> รายชั่วโมง
            </div>
            <div>
                <input class="radio-wrap" type="radio" id="dayly" name="shipping_type" value="dayly"
                    onchange="showForm('dayly')">รายวัน</input>
            </div>
            <div>
                <input class="radio-wrap" type="radio" id="monthly" name="shipping_type" value="monthly"
                    onchange="showForm('monthly')"> รายเดือน
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
                {{ $cars = $vehicleInfos->filter(function ($vehicleInfo) {
                    return $vehicleInfo->vehicle_type == 'รถยนต์';
                }) }}
                @if (isset($cars) && count($cars) == 0)
                    <option value="" disabled selected>ไม่มีหมายเลขทะเบียนรถยนต์</option>
                @endif
                @foreach ($vehicleInfos as $vehicleInfo)
                    @if ($vehicleInfo->vehicle_type == 'รถยนต์')
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div id="motorcycleForm" class="dropdow-wrap" style="display: none;">
            <label for="license_plate2">เลือกหมายเลขทะเบียน</label>
            <select class="dropdown-select" name="license_plate2">
                {{ $motorcycles = $vehicleInfos->filter(function ($vehicleInfo) {
                    return $vehicleInfo->vehicle_type == 'มอเตอร์ไซต์';
                }) }}
                @if (isset($motorcycles) && count($motorcycles) == 0)
                    <option value="" disabled selected>ไม่มีหมายเลขทะเบียนมอเตอร์ไซต์</option>
                @endif
                @foreach ($vehicleInfos as $vehicleInfo)
                    @if ($vehicleInfo->vehicle_type == 'มอเตอร์ไซต์')
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="dropdow-wrap">
            <label for="date_entry">วันที่เข้า:</label>
            <input class="input-date-time" type="date" name="date_entry" required>
        </div>

        <div class="time_period">
            <div id="time-start" class="timerStart">
                <label for="start">เวลาที่นำรถเข้า</label> <br>
                <select id="start" class="dropdown-select" name="time_start">
                    @for ($i = 0; $i < 24; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00">
                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                        </option>
                    @endfor
                </select>
            </div>

            <div class="dropdow-wrap">
                <label id="duration-label" for="duration"></label>
                <input class="input-duration" id="duration-input" type="number" name="duration" value="1"
                    required>
            </div>
        </div>

        <button type="submit" id="subbtn">จอง</button>
    </form>
</body>

</html>
