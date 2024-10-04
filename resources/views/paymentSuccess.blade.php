<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="{{ asset('user-payment-success.css') }}">
</head>

<body>

    <div class="container">
        <div class="success-icon">✔</div>
        <h1>ชำระเงินสำเร็จ!</h1>
        <p>ขอบคุณที่ใช้บริการ</p>
        <h1>ข้อมูลการจองที่จอดรถ</h1>
        <div id="output">
            <div class="info">
                <p>ประเภทการจอง: {{ $reserseType }}</p>
                <p>ประเภทรถ: {{ $parkingSpot->spot_type }}</p>
                <p>ป้ายทะเบียน: {{ $reservation->license_plate }}</p>
                <p>ที่จอดรถ: {{ $parkingSpot->spot_number }}</p>
                <p>วันที่นำรถเข้าจอด: {{ $reservation->start_time }}</p>
                <p>เวลาที่นำรถออก: {{ $reservation->end_time }}</p>
            </div>
            <div class="button">
                <a href="{{ url('/') }}">กลับสู่หน้าแรก</a>
            </div>
        </div>
</body>

</html>
