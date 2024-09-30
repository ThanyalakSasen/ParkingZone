<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('reservation.css') }}">
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
