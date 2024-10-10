{{-- promotion.blade.php --}}
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
            <select id="vehicle_type" name="vehicle_type" onchange="updatePrices()" required>
                <option value="car" {{ (isset($promotionToEdit) && $promotionToEdit->vehicle_type === 'car') ? 'selected' : '' }}>รถยนต์</option>
                <option value="motorcycle" {{ (isset($promotionToEdit) && $promotionToEdit->vehicle_type === 'motorcycle') ? 'selected' : '' }}>มอเตอร์ไซค์</option>
            </select>

            <div class="price-group">
                <div>
                    <label for="hourly_price">ราคาเต็มรายชั่วโมง:</label>
                    <input type="number" id="hourly_price" name="hourly_price" 
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->hourly_price : '40' }}" readonly>
                </div>
                <div>
                    <label for="daily_price">ราคาเต็มรายวัน:</label>
                    <input type="number" id="daily_price" name="daily_price" 
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->daily_price : '200' }}" readonly>
                </div>
            </div>

            <div class="price-group">
                <div>
                    <label for="discount_percentage">ส่วนลด (%):</label>
                    <input type="number" id="discount_percentage" name="discount_percentage"
                        value="{{ isset($promotionToEdit) ? $promotionToEdit->discount_percentage : '' }}" required>
                </div>
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
                        <th>ประเภทยานพาหนะ</th>
                        <th>ราคารายชั่วโมงที่มีส่วนลด</th>
                        <th>ราคารายวันที่มีส่วนลด</th>
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
                            <td>{{ $promotion->vehicle_type === 'car' ? 'รถยนต์' : 'มอเตอร์ไซค์' }}</td>
                            <td>{{ $promotion->hourly_discounted }} บาท</td>
                            <td>{{ $promotion->daily_discounted }} บาท</td>
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

            // Set the vehicle type based on the promotion
            document.getElementById('vehicle_type').value = promotion.vehicle_type;
            updatePrices(); // Update the prices based on the vehicle type

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

            // ตั้งค่าราคาให้กับรถยนต์และมอเตอร์ไซค์
            let hourlyPrice, dailyPrice;
            
            if (vehicleType === 'car') {
                hourlyPrice = 40; // ราคาเต็มรายชั่วโมงรถยนต์
                dailyPrice = 200;  // ราคาเต็มรายวันรถยนต์
            } else {
                hourlyPrice = 20; // ราคาเต็มรายชั่วโมงมอเตอร์ไซค์
                dailyPrice = 100;  // ราคาเต็มรายวันมอเตอร์ไซค์
            }

            // อัปเดตราคาในฟิลด์
            document.getElementById('hourly_price').value = hourlyPrice;
            document.getElementById('daily_price').value = dailyPrice;

            // คำนวณราคาที่มีส่วนลดหากมีการกรอกเปอร์เซ็นต์ส่วนลด
            const discountPercentageInput = document.getElementById('discount_percentage');
            const discountPercentage = parseFloat(discountPercentageInput.value);

            if (!isNaN(discountPercentage)) {
                const discountedHourlyPrice = hourlyPrice * (1 - discountPercentage / 100);
                const discountedDailyPrice = dailyPrice * (1 - discountPercentage / 100);

                document.getElementById('hourly_discounted').value = discountedHourlyPrice.toFixed(2);
                document.getElementById('daily_discounted').value = discountedDailyPrice.toFixed(2);
            }
        }

        // เรียกฟังก์ชัน updatePrices เมื่อโหลดหน้า
        window.onload = updatePrices;

        // Trigger the price update when the discount changes
        document.getElementById('discount_percentage').addEventListener('input', updatePrices);

        function handleFormSubmit() {
            alert('บันทึกโปรโมชันเรียบร้อยแล้ว!');
            return true; // Continue the form submission
        }
    </script>
@endsection
