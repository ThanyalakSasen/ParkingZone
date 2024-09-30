<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างโปรโมชันใหม่</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('promotions.css') }}">
</head>
<body>
    <div class="container">
        <h1>สร้างโปรโมชันใหม่</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('promotions.store') }}" method="POST">
            @csrf
            <label for="festival_name">ชื่อเทศกาล:</label>
            <input type="text" id="festival_name" name="festival_name" required>

            <label for="start_date">วันที่เริ่มต้น:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">วันที่สิ้นสุด:</label>
            <input type="date" id="end_date" name="end_date" required>

            <label for="hourly_price">ราคาแบบรายชั่วโมง:</label>
            <input type="number" id="hourly_price" name="hourly_price" required>

            <label for="daily_price">ราคาแบบรายวัน:</label>
            <input type="number" id="daily_price" name="daily_price" required>

            <label for="monthly_price">ราคาแบบรายเดือน:</label>
            <input type="number" id="monthly_price" name="monthly_price" required>

            <label for="hourly_discounted">ราคาโปรโมชั่นรายชั่วโมง:</label>
            <input type="number" id="hourly_discounted" name="hourly_discounted" required>

            <label for="daily_discounted">ราคาโปรโมชั่นรายวัน:</label>
            <input type="number" id="daily_discounted" name="daily_discounted" required>

            {{-- <label for="monthly_discounted">ราคาโปรโมชั่นรายเดือน:</label>
            <input type="number" id="monthly_discounted" name="monthly_discounted" required> --}}

            <button type="submit">สร้างโปรโมชัน</button>
        </form>

        <a href="{{ route('promotions.index') }}">กลับไปยังรายการโปรโมชัน</a>
    </div>
</body>
</html>
