<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 300px;
            background-color: #000048;
            height: 100vh;
            position: fixed;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar .profile-image-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin: 10px;
        }
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .sidebar p {
            text-align: center;
            margin-top: 5px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        .sidebar ul li.active {
            background-color: white;
            cursor: pointer;
        }
        .sidebar ul li.active a {
            color: #000;
        }
        .sidebar ul li:hover {
            background-color: white;
            color: black;
            cursor: pointer;
        }
        .sidebar ul li:hover a {
            color: #000;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 320px;
            padding: 20px;
            background-color: #fff;
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .latest-reservation {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="main-content">
        <!-- แสดงการจองล่าสุด -->
        @if ($latestReservation)
        <div class="latest-reservation">
            <h2>การจองล่าสุด</h2>
            <table>
                <tr>
                    <th>วันที่จอง:</th>
                    <td>{{ $latestReservation->booking_date }}</td>
                </tr>
                <tr>
                    <th>เวลาเข้า:</th>
                    <td>{{ $latestReservation->start_time }}</td>
                </tr>
                <tr>
                    <th>เวลาออก:</th>
                    <td>{{ $latestReservation->end_time }}</td>
                </tr>
                <tr>
                    <th>หมายเลขที่จอง:</th>
                    <td>{{ $latestReservation->reservation_number }}</td>
                </tr>
                <tr>
                    <th>ประเภทที่จอด:</th>
                    <td>{{ $latestReservation->parking_type }}</td>
                </tr>
                <tr>
                    <th>ป้ายทะเบียน:</th>
                    <td>{{ $latestReservation->license_plate }}</td>
                </tr>
                <tr>
                    <th>สถานะ:</th>
                    <td>{{ $latestReservation->parking_status }}</td>
                </tr>
                <tr>
                    <th>ราคา:</th>
                    <td>{{ $latestReservation->price }}</td>
                </tr>
            </table>
        </div>
        @endif

        <!-- แสดงประวัติการจองทั้งหมด -->
        <div id="dailySummary" class="section">
            <h1>ประวัติการจองที่จอดรถ</h1>
            <table id="summaryTable">
                <thead>
                    <tr>
                        <th>วันที่จอง</th>
                        <th>เวลาเข้า</th>
                        <th>เวลาออก</th>
                        <th>หมายเลขที่จอด</th>
                        <th>ประเภทที่จอดรถ</th>
                        <th>ป้ายทะเบียน</th>
                        <th>สถานะ</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->booking_date }}</td>
                        <td>{{ $reservation->start_time }}</td>
                        <td>{{ $reservation->end_time }}</td>
                        <td>{{ $reservation->reservation_number }}</td>
                        <td>{{ $reservation->parking_type }}</td>
                        <td>{{ $reservation->license_plate }}</td>
                        <td>{{ $reservation->parking_status }}</td>
                        <td>{{ $reservation->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
