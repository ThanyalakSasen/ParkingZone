<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกโปรโมชันและชำระเงิน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('payment.css') }}">
</head>
<body>
    <div class="container">
        <h1>ชำระเงินสำหรับการจองที่จอดรถ - เลือกโปรโมชัน</h1>
        
        <form action="{{ url('/payment_process') }}" method="POST">
            @csrf <!-- ป้องกัน CSRF -->

            <!-- กรอกอีเมลเพื่อรับใบเสร็จ -->
            <label for="email">กรอกอีเมลสำหรับส่งใบเสร็จ:</label>
            <input type="email" id="email" name="email" placeholder="ระบุอีเมล" required>

            <!-- ส่วนเลือกโปรโมชัน -->
            <label for="promotion">เลือกโปรโมชัน:</label>
            <select id="promotion" onchange="applyPromotion()">
                <option value="0">ไม่มีโปรโมชัน</option>
                @foreach ($promotions as $promotion)
                    <option value="{{ json_encode($promotion) }}">{{ $promotion->festival_name }}</option>
                @endforeach
            </select>

            <!-- แสดงราคาเต็มและราคาหลังจากหักส่วนลด -->
            <div class="price">
                <span class="original-price">ราคาเต็ม: ฿<span id="originalPrice">0</span></span>
                <span class="discounted-price">ราคาหลังหักส่วนลด: ฿<span id="discountedPrice">0</span></span>
            </div>

            <!-- ส่งราคาหลังหักส่วนลดไปยังฟอร์ม -->
            <input type="hidden" id="totalAmount" name="total_amount" value="0">

            <!-- แสดง QR Code -->
            <div class="qr-code">
                <label>สแกน QR Code เพื่อชำระเงิน:</label>
                <img src="images/payyyy.jpg" alt="QR Code สำหรับชำระเงิน">
            </div>

            <input type="submit" value="ชำระเงิน">
        </form>
    </div>

    <script>
        function applyPromotion() {
            const selectedPromotion = JSON.parse(document.getElementById('promotion').value || '{}');
            
            // ตรวจสอบและคำนวณราคาที่ลดแล้ว
            if (selectedPromotion && selectedPromotion.hourly_price) {
                const originalPrice = selectedPromotion.hourly_price; // ราคาเต็ม
                const discountedPrice = selectedPromotion.hourly_discounted; // ราคาที่ลดแล้ว

                // แสดงราคาทั้งสอง
                document.getElementById('originalPrice').innerText = originalPrice;
                document.getElementById('discountedPrice').innerText = discountedPrice;

                // ส่งราคาหลังหักส่วนลดไปยังฟอร์ม
                document.getElementById('totalAmount').value = discountedPrice;
            } else {
                // รีเซ็ตเมื่อไม่ได้เลือกโปรโมชัน
                document.getElementById('originalPrice').innerText = 0;
                document.getElementById('discountedPrice').innerText = 0;
                document.getElementById('totalAmount').value = 0;
            }
        }
    </script>
</body>
</html>