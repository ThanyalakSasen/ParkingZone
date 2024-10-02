<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('user-parking-spot.css') }}">
    <title>เพิ่มสถานที่จอดรถ</title>
</head>

<body>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session('errors'))
        <div class="error">{{ session('errors') }}</div>
    @endif

    <header>
        <h3>ParkingZone</h3>

        <form id="login" method="POST" action="{{ route('logout') }}">
            @csrf
            <p>โปรไฟล์</p>
            <button type="submit">Logout</button>
        </form>
    </header>

    <div class="container">
        <h3>เลือกที่จอดรถ</h3>
        @foreach ($floors as $floor)
            <h4>ชั้นที่: {{ $floor['floor'] . ' ' }} ({{ $floor['name'] }})</h4>
            <div class="spot-table">
                @foreach ($floor['spots'] as $spot)
                    <form method="POST" action="{{ route('user-parking-spots.update', $spot['id']) }}"
                        id="select-spot-form">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="spot-item {{ $spot['spot_type'] == 'รถยนตร์' ? 'spot-item-cars' : 'spot-item-motorcycle' }} {{ $spot['is_available'] ? 'spot-item-available' : 'spot-item-unavailable' }}"
                            onclick="selectSpot({{ (bool) $spot['is_available'] }})">
                            <span>{{ $spot['spot_number'] }}</span>
                            <input type="number" name="dashboard_id" value="{{ $dashboardId }}"
                                style="display: none">
                            <img class='spot-item-img'
                                src="{{ $spot['spot_type'] == 'รถยนตร์' ? asset('/car_icon.png') : asset('/motorcycle_icon.png') }}"
                                alt="">
                        </button>
                    </form>
                @endforeach
            </div>
        @endforeach
    </div>
    <script>
        function selectSpot(isAvailable) {
            if (!isAvailable) {
                return;
            }
            const form = document.getElementById('select-spot-form');
            form.action = `/parking-spots/${spot['id']}`;
            form.method = 'PATCH';
        }
    </script>
</body>

</html>
