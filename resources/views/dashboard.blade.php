<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองที่จอดรถ</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background-color: #011b60;
        }

        header {
            width: 100%;
            box-shadow: 0px 2px 15px black;
            background-color: #ffffff;
            color: #011b60;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        header h3 {
            margin-left: 15px;
        }

        header form {
            margin-left: auto;
            margin-right: 15px;
        }

        form #hourly-group .day {
            display: flex;
        }

        form #day-group div,
        form #monthly-group div {
            margin: 20px;
        }

        form #hourly-group .day div {
            margin: 10px;
            display: block;
        }

        .shippingType {
            display: flex;
        }

        form#main {
            color: #011b60;
            width: 50%;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
        }

        form#main h3 {
            text-align: center;
        }

        form#main .shippingType div {
            margin-left: auto;
            margin-right: auto;
        }

        form#main #hourly-group {
            display: block;
        }

        form#main #hourly-group, #day-group, #monthly-group {
            display: none;
            margin-left: 90px;
        }

        .vehicleType {
            margin: 20px;
            display: block;
            padding-left: 70px;
        }

        .shippingType div {
            margin-right: 20px;
        }

        #subbtn {
            width: 80px;
            height: 30px;
            background-color: #011b60;
            font-weight: bold;
            color: #ffffff;
            border: 0;
            border-radius: 16px;
            margin-top: 20px;
            margin-left: auto; 
            margin-right: auto; 

            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        #motorcycleForm select, #vehicleForm select {
            width: 200px;
        }

        #motorcycleForm, #vehicleForm {
            display: none;
            transition: display 0.5s ease-in-out;
        }

        table {
            border: 1px solid white;
            border-radius: 10px;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            color: #ffffff;
        }
    </style>

    <script>
        function showForm(type) {
            const hourlyGroup = document.getElementById('hourly-group');
            const dayGroup = document.getElementById('day-group');
            const monthlyGroup = document.getElementById('monthly-group');

            hourlyGroup.style.display = 'none';
            dayGroup.style.display = 'none';
            monthlyGroup.style.display = 'none';

            if (type === 'hourly') {
                hourlyGroup.style.display = 'block';
            } else if (type === 'day') {
                dayGroup.style.display = 'block';
            } else if (type === 'monthly') {
                monthlyGroup.style.display = 'block';
            }
        }

        function showVehicleForm(type) {
            const carForm = document.getElementById('vehicleForm');
            const motorcycleForm = document.getElementById('motorcycleForm');

            motorcycleForm.style.display = 'none';
            carForm.style.display = 'none';

            if (type === 'รถยนต์') {
                carForm.style.display = 'block';
            } else if (type === 'มอเตอร์ไซต์') {
                motorcycleForm.style.display = 'block';
            }
        }

        window.onload = function() {
            showForm('hourly');
        };
    </script>
</head>
<body>
    <header>
        <h3>ParkingZone</h3>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form id="main" action="{{ route('dashboard.create') }}" method="POST">
        @csrf
        <h3>ค้นหาที่จอดรถ</h3>
        <div class="shippingType">
            <div>
                <input type="radio" id="hourly" name="shipping_type" value="hourly" checked onchange="showForm('hourly')">
                <label for="hourly">รายชั่วโมง</label>
            </div>
            <div>
                <input type="radio" id="day" name="shipping_type" value="day" onchange="showForm('day')">
                <label for="day">รายวัน</label>
            </div>
            <div>
                <input type="radio" id="monthly" name="shipping_type" value="monthly" onchange="showForm('monthly')">
                <label for="monthly">รายเดือน</label>
            </div>
        </div>

        <div id="hourly-group">
            <div class="vehicleType">
                <select name="vehicle_type" id="vehicleType" onchange="showVehicleForm(this.value)">
                    <option value="">เลือกประเภท</option>
                    <option value="รถยนต์">รถยนต์</option>
                    <option value="มอเตอร์ไซต์">มอเตอร์ไซต์</option>
                </select>
            </div>
            <div id="vehicleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div id="motorcycleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_entry">วันที่เข้า:</label>
                <input type="datetime-local" name="date_entry" required>
            </div>
            <div>
                <label for="date_exit">วันที่ออก:</label>
                <input type="datetime-local" name="date_exit" required>
            </div>

        </div>

        <div id="day-group">
            <div class="vehicleType">
                <select name="vehicle_info" id="vehicleType" onchange="showVehicleForm(this.value)">
                    <option value="">เลือกประเภท</option>
                    <option value="รถยนต์">รถยนต์</option>
                    <option value="มอเตอร์ไซต์">มอเตอร์ไซต์</option>
                </select>
            </div>
            <div id="vehicleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div id="motorcycleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_entry">วันที่เข้า:</label>
                <input type="datetime-local" name="date_entry" required>
            </div>
            <div>
                <label for="date_exit">วันที่ออก:</label>
                <input type="datetime-local" name="date_exit" required>
            </div>

        </div>

        <div id="monthly-group">
            <div class="vehicleType">
                <select name="vehicle_type" id="vehicleType" onchange="showVehicleForm(this.value)">
                    <option value="">เลือกประเภท</option>
                    <option value="รถยนต์">รถยนต์</option>
                    <option value="มอเตอร์ไซต์">มอเตอร์ไซต์</option>
                </select>
            </div>
            <div id="vehicleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div id="motorcycleForm">
                <select name="vehicle_info">
                    <option value="">เลือกหมายเลขทะเบียน</option>
                    @foreach($vehicleInfos as $vehicleInfo)
                        <option value="{{ $vehicleInfo->license_plate }}">{{ $vehicleInfo->license_plate }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_entry">วันที่เข้า:</label>
                <input type="datetime-local" name="date_entry" required>
            </div>
            <div>
                <label for="date_exit">วันที่ออก:</label>
                <input type="datetime-local" name="date_exit" required>
            </div>
        </div>

        <button type="submit" id="subbtn">สร้าง</button>
    </form>

    <table>
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
            @foreach($dashboards as $dashboard)
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
    </table>
</body>
</html>