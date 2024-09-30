<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงินสำหรับการจองที่จอดรถ - โปรโมชั่น</title>
    <link rel="stylesheet" href="{{ asset('payment.css') }}">
</head>

<body>
    <div class="container">
        <h1>ชำระเงินสำหรับการจองที่จอดรถ - โปรโมชัน</h1>
        <form method="POST" action="{{ route('payment.create') }}">
            @csrf <!-- ใช้เพื่อป้องกัน CSRF -->
            <label for="email">กรอกอีเมลสำหรับส่งใบเสร็จ:</label>
            <input type="email" id="email" name="email" placeholder="ระบุอีเมล" required>

            <!-- ส่วนนี้แสดงราคาเต็มและราคาที่ลดแล้ว -->
            <div class="price">
                <span class="original-price">฿200</span> <!-- ราคาเต็มที่ถูกขีดฆ่า -->
                <span class="discounted-price">฿150</span> <!-- ราคาที่ลดแล้ว -->
            </div>

            <div class="qr-code">
                <label>สแกน QR Code เพื่อชำระเงิน:</label>
                <img src="{{ asset('payment/qrcode.jpg') }}" alt="QR Code สำหรับชำระเงิน">
                <!-- เปลี่ยน URL เป็น QR Code ของคุณ -->
            </div>

            <input type="hidden" name="total_amount" value="150"> <!-- เก็บราคาที่ลดแล้วในฟอร์ม -->

            <input type="submit" value="ชำระเงินเสร็จสิ้น">
        </form>
    </div>
</body>

</html>
