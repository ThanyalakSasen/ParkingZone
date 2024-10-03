<!-- resources/views/layouts/sidebar.blade.php -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        display: flex;
    }
    .sidebar {
        width: 300px;
        background-color: #000048;
        height: 100vh;
        position: fixed;
        color: #fff;
        padding-top: 20px;
    }
    .sidebar .profile-image-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        margin: 10px;
    }
    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .sidebar p {
        text-align: center;
        margin-top: 5px;
    }
    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .sidebar ul li {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid #444;
    }
    .sidebar ul li.active {
        background-color: white;
        cursor: pointer;
    }
    .sidebar ul li.active a {
        color: #000;
    }
    .sidebar ul li:hover {
        background-color: white;
        color: black;
        cursor: pointer;
    }
    .sidebar ul li:hover a {
        color: #000;
    }
    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    .sidebar ul li a i {
        margin-right: 10px;
    }
</style>

<!-- Sidebar HTML -->
<div class="sidebar">
    <div class="container">
        <!-- รูปภาพผู้ใช้อยู่ข้างบน -->
        <div class="profile-image-container">
            <div class="profile-image" id="profilePreview">
                <img src="https://via.placeholder.com/120" alt="Profile Image">
            </div>
        </div>
        <!-- แสดงอีเมลผู้ใช้งาน -->
        <p>{{ $customer->email ?? 'No Email' }}</p>
        <ul>
            <li><a href="{{ url('/customer') }}"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</a></li>
            <li><a href="{{ url('car-info') }}"><i class="fas fa-car"></i> ข้อมูลรถของคุณ</a></li>
        </ul>
    </div>
</div>
