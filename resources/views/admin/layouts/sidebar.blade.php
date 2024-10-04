<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin-sidebar.css') }}">
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
                    <a href="{{ route('admin.parking-spots.index') }}">
                        <li class="{{ Request::is('admin/parking-spots*') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span>จัดการจุดจอดรถ</span>
                        </li>
                    </a>
                    <a href="{{ route('admin.parking-floors.index') }}">
                        <li class="{{ Request::is('admin/parking-floors*') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>จัดการชั้นที่จอด</span>
                        </li>
                    </a>
                    <a href="{{ route('admin.promotions.index') }}">
                        <li class="{{ Request::is('admin/promotions*') ? 'active' : '' }}">
                            <i class="fas fa-car"></i>
                            <span>จัดการโปรโมชัน</span>
                        </li>
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}">
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
