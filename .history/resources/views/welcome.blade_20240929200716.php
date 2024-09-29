<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ParkingZone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <header>
        <a href="{{ url('/welcome') }}"><img src="../../img/logo.png" alt=""></a>
        <h3>ParkingZone</h3>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/praking') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">praking</a>
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">เข้าสู่ระบบ</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">สมัครสมาชิก</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <section>
        <div class="container">
            <img src="../img/parking_lot.jpg" alt="" style="width:100%">
            <div id="centered">ค้นหาและจองที่จอดรถด้วย ParkingZone</div>
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
