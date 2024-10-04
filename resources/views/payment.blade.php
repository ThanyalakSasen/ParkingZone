<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <title>ชำระเงินสำหรับการจองที่จอดรถ - โปรโมชั่น</title>
    <link rel="stylesheet" href="{{ asset('user-payment.css') }}">
</head>

<body>
    <div class="container">
        <h1>ชำระเงินสำหรับการจองที่จอดรถ - โปรโมชัน</h1>
        <form method="POST" action="{{ route('payment.create') }}">
            @csrf <!-- ใช้เพื่อป้องกัน CSRF -->
            <label for="promotion">เลือกโปรโมชัน:</label>
            <select id="promotion" onchange="applyPromotion()" class="select-promotion">
                @foreach ($promotions as $promotion)
                    <option value="{{ json_encode($promotion) }}">{{ $promotion->festival_name }}</option>
                @endforeach
            </select>

            <div class="price">
                <div class="original-price">ราคาเต็ม: ฿<span id="originalPrice">0</span></div>
                <div class="discounted-price">ราคาหลังหักส่วนลด: ฿<span id="discountedPrice">0</span></div>
            </div>

            <div class="qr-code">
                <label>สแกน QR Code เพื่อชำระเงิน:</label>
                <img src="{{ asset('payment/qrcode.jpg') }}" alt="QR Code สำหรับชำระเงิน">
            </div>

            <div class="total-price" id="total-price">
            </div>

            <input type="hidden" name="spot_id" value="{{ $spotId }}">
            <input type="hidden" name="dashboard_id" value="{{ $dashboardId }}">
            <input type="hidden" name="price" id='input-price'>
            <input type="submit" value="ชำระเงินเสร็จสิ้น">
        </form>
    </div>

    <script>
        function applyPromotion() {
            const selectedPromotion = JSON.parse(document.getElementById('promotion').value || '{}');
            var shippingType = @json($shippingType);
            var duration = @json($duration);


            rate = 0;
            if (shippingType == 'hourly') {
                rate = parseFloat(selectedPromotion.hourly_price);
            } else if (shippingType == 'dayly') {
                rate = parseFloat(selectedPromotion.daily_price);
            } else if (shippingType == 'monthly') {
                rate = parseFloat(selectedPromotion.monthly_price);
            }
            totalBeforeDiscount = rate * parseFloat(duration);

            discountRate = parseFloat(selectedPromotion.discount_percentage) / 100;
            totalAfterDisCount = (1 - discountRate) * totalBeforeDiscount;
            console.log((100 - parseFloat(selectedPromotion.discount_percentage)))

            document.getElementById('originalPrice').innerText = totalBeforeDiscount;
            document.getElementById('discountedPrice').innerText = totalAfterDisCount;
            document.getElementById('total-price').innerText = `ยอดชำระทั้งหมด ${totalAfterDisCount} บาท`;
            document.getElementById('input-price').value = totalAfterDisCount;
        }
        applyPromotion();
    </script>
</body>

</html>
