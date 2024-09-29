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
        <style>
            @font-face {
                font-family: Noto_sans_thai;
                src: url("../Noto_Sans_Thai/NotoSansThai-VariableFont_wdth,wght.ttf");
            }
            body{
                font-family: "Noto_sans_thai",sans-serif;
                margin: 0px;
                padding: 0px;
            }
            header{
                display: flex;
                background-color: #ffffff;
                color: #011b60;
                box-shadow: 0px 2px 15px black;
                padding: 15px;
            }
            header h3{
                margin-left: 10px;
                width: 75%;
            }
            header img{
                margin-left: 5%;
                width: 60px;
                height: auto;
            }
            a{
                margin-right: 30px;
                color: #011b60;
                text-decoration: none;
                font-weight: bold;
            }
            nav{
                margin-top: auto;
                margin-bottom: auto;
            }
            .container {
                position: relative;
                text-align: center;
                color: white;
            }
            #centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #011b60;
                color: #ffffff;
                padding: 20px;
                border-radius: 40px;
                font-size: x-large;
                font-weight: bolder;
            }
            #main{
                background-color: #011b60;
                width: 100%;
                display: flex;
                color: #ffffff;
                display: flex;
                justify-content: center;

            }
            #main .sub-main{
                width: 30%;
                text-align: center
            }
            #main .sub-main img{
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }
            #main .sub-main p{
                font-weight: normal;
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <header>
            <a href="{{url('/welcome')}}"><img src="../../img/logo.png" alt=""></a>
            <h3>ParkingZone</h3>
            @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/praking') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >praking</a>
                        <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >dashboard</a>   
            @else
                <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >เข้าสู่ระบบ</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >สมัครสมาชิก</a>
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
{{-- <div class="container-1" style="width:50%">
    <form action="">
    <div id="centered" style="width:100%">
        <p>ค้นหาที่จอดรถ</p>
        <div id="findplace">
                <div>
                    <button>รายชั่วโมง</button>
                    <button>รายวัน</button>
                    <button>รายเดือน</button>
                </div>
                <div>
                    <label for="place">สถานที่</label><br>
                    <select name="place" id="place">
                        <option value="เซนทรัล">เซนทรัล</option>
                        <option value="โลตัส-สาขาโนนม่วง">โลตัส สาขาโนนม่วง</option>
                    </select>
                </div>
                <div>
                    <label for="day">วันที่เข้าจอด</label><br>
                    <input type="date">
                </div>
        </div>
            <input type="submit" value="ค้นหาที่จอด">
        </form>
    </div> --}}