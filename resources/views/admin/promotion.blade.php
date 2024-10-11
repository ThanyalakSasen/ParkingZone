@extends('admin.layouts.sidebar')

@section('title', 'เพิ่มโปรโมชัน')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-promotions.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>เพิ่มโปรโมชัน</h1>
        <form method="POST"
            action="{{ isset($promotionToEdit) ? route('admin.promotions.update', $promotionToEdit->id) : route('admin.promotions.store') }}"
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

            <label for="vehicle_type">ประเภทยานพาหนะ:</label>
            <select id="vehicle_type" name="vehicle_type" class="dropdown-select" onchange="updatePrices()" required>
                <option value="รถยนต์"
                    {{ isset($promotionToEdit) && $promotionToEdit->vehicle_type === 'รถยนต์' ? 'selected' : '' }}>รถยนต์
                </option>
                <option value="มอเตอร์ไซต์"
                    {{ isset($promotionToEdit) && $promotionToEdit->vehicle_type === 'มอเตอร์ไซต์' ? 'selected' : '' }}>
                    มอเตอร์ไซต์</option>
            </select>

            <div class="price-group">
                <div>
                    <label for="hourly_price">ราคาเต็มรายชั่วโมง:</label>
                    <input type="number" id="hourly_price" name="hourly_price" step="0.01" value="{{ '' }}"
                        required>
                </div>
                <div>
                    <label for="daily_price">ราคาเต็มรายวัน:</label>
                    <input type="number" id="daily_price" name="daily_price" step="0.01" value="{{ '' }}"
                        required>
                </div>
            </div>

            <div class="price-group">
                <div>
                    <label for="monthly_price">ราคาเต็มรายเดือน:</label>
                    <input type="number" id="monthly_price" name="monthly_price" value="{{ '' }}" required>
                </div>
                <div>
                    <label for="discount_percentage">ส่วนลด (%):</label>
                    <input type="number" id="discount_percentage" name="discount_percentage" value="{{ '' }}"
                        required>
                </div>
            </div>
            <input id="input-form-submit" type="submit" value="บันทึกโปรโมชั่น">

        </form>

        <div class="promotion-list" id="promotionList">
            <h2>รายการโปรโมชันที่มีอยู่</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ชื่อโปรโมชัน</th>
                        <th>ประเภท</th>
                        <th>วันเริ่ม</th>
                        <th>วันสิ้นสุด</th>
                        <th>ราคารายชั่วโมง</th>
                        <th>ราคารายวัน</th>
                        <th>ราคารายเดือน</th>
                        <th>ส่วนลด(%)</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->id }}</td>
                            <td>{{ $promotion->festival_name }}</td>
                            <td>{{ $promotion->vehicle_type }}</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ $promotion->hourly_price }}</td>
                            <td>{{ $promotion->daily_price }}</td>
                            <td>{{ $promotion->monthly_price }}</td>
                            <td>{{ $promotion->discount_percentage }}</td>
                            <td>
                                <div>
                                    <button class="manage-btn edit"
                                        onclick="editPromotion({{ $promotion }})">แก้ไข</button>
                                    <form method="POST" action="{{ route('admin.promotions.destroy', $promotion->id) }}"
                                        style="display:inline;" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="manage-btn delete">ลบ</button>
                                    </form>
                                </div>
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
            document.getElementById('discount_percentage').value = promotion.discount_percentage;

            const vehicleType = document.getElementById('vehicle_type').value;
            let hourlyPrice, dailyPrice, monthlyPrice;

            if (vehicleType === 'รถยนต์') {
                hourlyPrice = 40;
                dailyPrice = 200;
                monthlyPrice = 2000;
            } else {
                hourlyPrice = 20;
                dailyPrice = 100;
                monthlyPrice = 1000;
            }

            document.getElementById('hourly_price').value = hourlyPrice;
            document.getElementById('daily_price').value = dailyPrice;
            document.getElementById('monthly_price').value = monthlyPrice;

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

        function updatePrices() {
            const vehicleType = document.getElementById('vehicle_type').value;
            let hourlyPrice, dailyPrice, monthlyPrice;

            if (vehicleType === 'รถยนต์') {
                hourlyPrice = 40;
                dailyPrice = 200;
                monthlyPrice = 2000;
            } else {
                hourlyPrice = 20;
                dailyPrice = 100;
                monthlyPrice = 1000;
            }

            document.getElementById('hourly_price').value = hourlyPrice;
            document.getElementById('daily_price').value = dailyPrice;
            document.getElementById('monthly_price').value = monthlyPrice;
        }

        function handleFormSubmit() {
            alert('บันทึกโปรโมชันเรียบร้อยแล้ว!');
            return true; // Continue the form submission
        }

        updatePrices()
    </script>
@endsection
