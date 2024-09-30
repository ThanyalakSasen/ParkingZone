<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มโปรโมชัน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('promotions.css') }}">
</head>

<body>
    <div class="container">
        <h1>เพิ่มโปรโมชัน</h1>
        <form method="POST"
            action="{{ isset($promotionToEdit) ? route('promotions.update', $promotionToEdit->id) : route('promotions.store') }}"
            id="promotionForm" onsubmit="return handleFormSubmit();">
            @csrf
            @if (isset($promotionToEdit))
                @method('PUT')
            @endif

            <label for="festival_name">ชื่อโปรโมชัน:</label>
            <input type="text" id="festival_name" name="festival_name" placeholder="ระบุชื่อโปรโมชัน"
                value="{{ isset($promotionToEdit) ? $promotionToEdit->festival_name : '' }}" required>

            <label for="start_date">วันเริ่มโปรโมชัน:</label>
            <input type="date" id="start_date" name="start_date"
                value="{{ isset($promotionToEdit) ? $promotionToEdit->start_date : '' }}" required>

            <label for="end_date">วันสิ้นสุดโปรโมชัน:</label>
            <input type="date" id="end_date" name="end_date"
                value="{{ isset($promotionToEdit) ? $promotionToEdit->end_date : '' }}" required>

            <div class="price-group">
                <div>
                    <label for="hourly_price">ราคาเต็มรายชั่วโมง:</label>
                    <input type="number" id="hourly_price" name="hourly_price" step="0.01"
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->hourly_price : '' }}" required>
                </div>
                <div>
                    <label for="daily_price">ราคาเต็มรายวัน:</label>
                    <input type="number" id="daily_price" name="daily_price" step="0.01"
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->daily_price : '' }}" required>
                </div>
                {{-- <div>
                    <label for="monthly_price">ราคาเต็มรายเดือน:</label>
                    <input type="number" id="monthly_price" name="monthly_price" value="{{ isset($promotionToEdit) ? $promotionToEdit->monthly_price : '' }}" required>
                </div> --}}
            </div>

            <div class="price-group">
                <div>
                    <label for="hourly_discounted">ราคาที่ลดแล้วรายชั่วโมง:</label>
                    <input type="number" id="hourly_discounted" name="hourly_discounted" step="0.01"
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->hourly_discounted : '' }}" required>
                </div>
                <div>
                    <label for="daily_discounted">ราคาที่ลดแล้วรายวัน:</label>
                    <input type="number" id="daily_discounted" name="daily_discounted" step="0.01"
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->daily_discounted : '' }}" required>
                </div>
                {{-- <div>
                    <label for="monthly_discounted">ราคาที่ลดแล้วรายเดือน:</label>
                    <input type="number" id="monthly_discounted" name="monthly_discounted" value="{{ isset($promotionToEdit) ? $promotionToEdit->monthly_discounted : '' }}" required>
                </div> --}}
            </div>
            <input id="input-form-submit" type="submit" value="บันทึกโปรโมชั่น">

        </form>

        <div class="promotion-list" id="promotionList">
            <h2>รายการโปรโมชันที่มีอยู่</h2>
            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ชื่อโปรโมชัน</th>
                        <th>วันเริ่ม</th>
                        <th>วันสิ้นสุด</th>
                        <th>ราคาเต็มรายชั่วโมง</th>
                        <th>ราคาเต็มรายวัน</th>
                        {{-- <th>ราคาเต็มรายเดือน</th> --}}
                        <th>ราคาโปรโมชั่นรายชั่วโมง</th>
                        <th>ราคาโปรโมชั่นรายวัน</th>
                        {{-- <th>ราคาโปรโมชั่นรายเดือน</th> --}}
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->id }}</td>
                            <td>{{ $promotion->festival_name }}</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ $promotion->hourly_price }}</td>
                            <td>{{ $promotion->daily_price }}</td>
                            {{-- <td>{{ $promotion->monthly_price }}</td> --}}
                            <td>{{ $promotion->hourly_discounted }}</td>
                            <td>{{ $promotion->daily_discounted }}</td>
                            {{-- <td>{{ $promotion->monthly_discounted }}</td> --}}
                            <td>
                                <form method="POST" action="{{ route('promotions.destroy', $promotion->id) }}"
                                    style="display:inline;" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">ลบ</button>
                                </form>
                                <button class="edit-btn" onclick="editPromotion({{ $promotion }})">แก้ไข</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('คุณแน่ใจหรือว่าต้องการลบโปรโมชันนี้?');
        }

        function editPromotion(promotion) {
            alert('กำลังแก้ไขโปรโมชัน: ' + promotion.festival_name);

            document.getElementById('festival_name').value = promotion.festival_name;
            document.getElementById('start_date').value = promotion.start_date;
            document.getElementById('end_date').value = promotion.end_date;
            document.getElementById('hourly_price').value = promotion.hourly_price;
            document.getElementById('daily_price').value = promotion.daily_price;
            // document.getElementById('monthly_price').value = promotion.monthly_price;
            document.getElementById('hourly_discounted').value = promotion.hourly_discounted;
            document.getElementById('daily_discounted').value = promotion.daily_discounted;
            // document.getElementById('monthly_discounted').value = promotion.monthly_discounted;

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            const form = document.getElementById('promotionForm');
            form.action = `/admin/promotions/${promotion.id}`;
            form.method = 'POST';

            const inputSubmit = document.getElementById('input-form-submit');
            inputSubmit.value = 'อัปเดตโปรโมชัน';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_method';
            csrfInput.value = 'PUT';
            form.appendChild(csrfInput);
        }

        function handleFormSubmit() {
            alert('บันทึกโปรโมชันเรียบร้อยแล้ว!');
            return true; // Continue the form submission
        }
    </script>
</body>

</html>
