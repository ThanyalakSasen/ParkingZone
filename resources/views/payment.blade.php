@extends('layouts.sidebar')

@section('content')
<link rel="stylesheet" href="{{ asset('user-payment.css') }}">
<div class="container">
    <h1>ชำระเงินสำหรับการจองที่จอดรถ - โปรโมชัน</h1>
    <form method="POST" action="{{ route('payment.create') }}" enctype="multipart/form-data">
        @csrf
        <label for="promotion">เลือกโปรโมชัน:</label>
        <select id="promotion" onchange="applyPromotion()" class="select-promotion">
            <option value="">-- เลือกโปรโมชัน --</option>
            @foreach ($promotions as $promotion)
                <option value="{{ json_encode($promotion) }}">{{ $promotion->festival_name }}</option>
            @endforeach
        </select>

        <label for="vehicleType">ประเภทของยานพาหนะ:</label>
<span id="vehicleTypeText">{{ $dashboard->vehicle_type == 'car' ? 'รถยนต์' : 'มอเตอร์ไซค์' }}</span>

<label for="duration">ระยะเวลาที่จอด:</label>
<span id="durationText">{{ $dashboard->duration }} {{ $shippingType }}</span>

<div class="total-price" id="total-price">
    ยอดชำระทั้งหมด ฿<span id="totalPriceText">{{ $totalPrice }}</span>
</div>


        <div class="qr-code">
            <label>สแกน QR Code เพื่อชำระเงิน:</label>
            <img src="{{ asset('payment/qrcode.jpg') }}" alt="QR Code สำหรับชำระเงิน">
        </div>

        <div class="upload-slip">
            <label for="paymentSlip">แนบสลิปการชำระเงิน:</label>
            <input type="file" id="paymentSlip" name="payment_slip" accept="image/*" required>
        </div>

        <input type="hidden" name="spot_id" value="{{ $spotId }}">
        <input type="hidden" name="dashboard_id" value="{{ $dashboardId }}">
        <input type="hidden" name="price" id='input-price'>
        <input type="submit" value="ชำระเงินเสร็จสิ้น">
    </form>
</div>

<script>
    const prices = @json($prices); // ส่งข้อมูลราคาจาก PHP ไปยัง JavaScript
    const vehicleType = document.getElementById('vehicleType').value;
    const duration = parseInt(document.getElementById('duration').value);
    const shippingType = '{{ $shippingType }}'; // ดึงค่าจาก PHP

    let totalPrice = 0;

    if (!isNaN(duration) && duration > 0) {
        totalPrice = prices[vehicleType][shippingType] * duration; // คำนวณตามประเภทของรถและระยะเวลา
    }

    document.getElementById('totalPriceText').innerText = totalPrice.toFixed(2); // แสดงยอดชำระรวม
    document.getElementById('input-price').value = totalPrice.toFixed(2); // เก็บยอดชำระใน input hidden
</script>
@endsection
