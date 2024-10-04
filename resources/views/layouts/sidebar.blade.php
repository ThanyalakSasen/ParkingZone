<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user-sidebar.css') }}">
    @stack('styles')
</head>

<body>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session('errors'))
        <div class="error">{{ session('errors') }}</div>
    @endif

    <div class="body-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <!-- รูปภาพผู้ใช้อยู่ข้างบน -->
                <div class="profile-image-container">
                    <div class="profile-image" id="profilePreview">
                        <img src="https://via.placeholder.com/120" alt="Profile Image">
                    </div>
                </div>
                <p class="sidebar-email">{{ Auth::user()->email }}</p>
                <ul>
                    <a href="{{ url('/') }}">
                        <li>
                            <i class="fas fa-home"></i>
                            <span>หน้าแรก</span>
                        </li>
                    </a>
                    <a href="{{ route('profile.edit') }}">
                        <li class="{{ Request::is('profile') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span>ข้อมูลส่วนตัว</span>
                        </li>
                    </a>
                    <a href="{{ route('vehicle.index') }}">
                        <li class="{{ Request::is('vehicle-info*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>ข้อมูลรถของคุณ</span>
                        </li>
                    </a>
                    <a href="{{ route('reservations.index') }}">
                        <li class="{{ Request::is('reservation*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>ประวัติการจอง</span>
                        </li>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-logout">
                            <li>
                                <i class="fas fa-sign-out-alt"></i>
                                <span>ออกจากระบบ</span>
                            </li>
                        </button>
                    </form>
                </ul>
            </div>
        </div>

        <div class="content-container">
            @yield('content')
        </div>
    </div>

</body>

</html>
