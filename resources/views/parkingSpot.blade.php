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
        <a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" alt=""></a>
        <h3>ParkingZone</h3>
        <div class="navigation-wrap">
            <a href="{{ route('reservations.index') }}">ประวัติการจอง</a>
            <a href="{{ route('vehicle.create') }}">เพิ่มข้อมูลรถ</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    logout
                </button>
            </form>
        </div>
    </header>

    <div class="container">
        <h3>เลือกที่จอดรถ</h3>
        @foreach ($floors as $floor)
            <h4>ชั้นที่: {{ $floor['floor'] . ' ' }} ({{ $floor['name'] }})</h4>
            <div class="spot-table">
                @foreach ($floor['spots'] as $spot)
                    <form method="POST" action="{{ route('user-parking-spots.update', $spot['id']) }}"
                        id="select-spot-form"
                        onsubmit="return  selectSpot(event, {{ (bool) $spot['is_available'] }}, {{ $spot['id'] }})">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="dashboard_id" value="{{ $dashboardId }}" style="display: none">

                        @if ($spot['is_available'])
                            <button type="submit"
                                class="spot-item {{ $spot['spot_type'] == 'รถยนต์' ? 'spot-item-cars' : 'spot-item-motorcycle' }} spot-item-available">
                                <span>{{ $spot['spot_number'] }}</span>
                                <img class='spot-item-img'
                                    src="{{ $spot['spot_type'] == 'รถยนต์' ? asset('/car_icon.png') : asset('/motorcycle_icon.png') }}"
                                    alt="">
                            </button>
                        @else
                            <button type="reset"
                                class="spot-item {{ $spot['spot_type'] == 'รถยนต์' ? 'spot-item-cars' : 'spot-item-motorcycle' }} spot-item-unavailable">
                                <span>{{ $spot['spot_number'] }}</span>
                                <img class='spot-item-img'
                                    src="{{ $spot['spot_type'] == 'รถยนต์' ? asset('/car_icon.png') : asset('/motorcycle_icon.png') }}"
                                    alt="">
                            </button>
                        @endif
                    </form>
                @endforeach
            </div>
        @endforeach
    </div>
    <script>
        function selectSpot(event, isAvailable, spotId) {
            if (!isAvailable) {
                event.preventDefault();
                return false;
            }
            const form = document.getElementById('select-spot-form');
            form.action = `/parking-spots/${spotId}`;
            return true;
        }
    </script>
</body>

</html>
