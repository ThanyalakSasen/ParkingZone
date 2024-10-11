<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <title>ParkingZone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('welcome.css') }}">
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <header>
        <a href="{{ url('/') }}"><img src="../../img/logo.png" alt=""></a>
        <h3>ParkingZone</h3>
        <div class="navigation-wrap">
            @auth
                <a href="{{ route('reservations.index') }}">ประวัติการจอง</a>
                <a href="{{ route('vehicle.create') }}">เพิ่มข้อมูลรถ</a>
            @else
                <a href="{{ route('admin.login')}}">สำหรับพนักงาน</a>
                <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
                <a href="{{ route('register') }}">สมัครสมาชิก</a>
            @endauth
        </div>
    </header>
    <section>
        <div class="container">
            <img src="../img/parking_lot.jpg" alt="" style="width:100%">
            <a id="centered" href="{{ url('/login') }}">ค้นหาและจองที่จอดรถด้วย ParkingZone</a>
        </div>
        <div id="main">
            <div class="sub-main">
                <img src="../img/456.png" alt="">
                <p>จองที่จอดรถ</p>
            </div>
            <div class="sub-main">
                <img src="../img/pikaso_embed1.png" alt="">
                <p>ขับรถถึงจุดจอดรถที่จองไว้</p>
            </div>
            <div class="sub-main">
                <img src="../img/pikaso_embed.png" alt="">
                <p>ถอยรถเข้าที่จอด</p>
            </div>

        </div>
    </section>
</body>

</html>
