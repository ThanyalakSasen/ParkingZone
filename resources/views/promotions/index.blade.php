<!DOCTYPE html>
<html lang="th">
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
        
        <!-- ฟอร์มเพิ่มโปรโมชัน -->
        <form id="promotionForm" method="POST" action="{{ route('promotions.store') }}">
            @csrf
            <input type="hidden" id="promotion_id" name="promotion_id">
            <label for="festival_name">ชื่อโปรโมชัน:</label>
            <input type="text" id="festival_name" name="festival_name" placeholder="ระบุชื่อโปรโมชัน" required>

            <label for="start_date">วันเริ่มโปรโมชัน:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">วันสิ้นสุดโปรโมชัน:</label>
            <input type="date" id="end_date" name="end_date" required>

            <div class="price-group">
                <div>
                    <label for="hourly_price">ราคาเต็มรายชั่วโมง:</label>
                    <input type="number" id="hourly_price" name="hourly_price" required>
                </div>
                <div>
                    <label for="daily_price">ราคาเต็มรายวัน:</label>
                    <input type="number" id="daily_price" name="daily_price" required>
                </div>
                <div>
                    <label for="monthly_price">ราคาเต็มรายเดือน:</label>
                    <input type="number" id="monthly_price" name="monthly_price" required>
                </div>
            </div>

            <label for="discount_percentage">ส่วนลด (%):</label>
            <input type="number" id="discount_percentage" name="discount_percentage" placeholder="ระบุเปอร์เซ็นต์ส่วนลด" required>

            <input type="submit" value="บันทึกโปรโมชัน">
        </form>

        <!-- แสดงรายการโปรโมชันที่มีอยู่ -->
        <div class="promotion-list" id="promotionList">
            <h2>รายการโปรโมชันที่มีอยู่</h2>
            <table>
                <thead>
                    <tr>
                        <th>ชื่อโปรโมชัน</th>
                        <th>วันเริ่ม</th>
                        <th>วันสิ้นสุด</th>
                        <th>ราคาเต็มรายชั่วโมง</th>
                        <th>ราคาเต็มรายวัน</th>
                        <th>ราคาเต็มรายเดือน</th>
                        <th>ราคาโปรโมชั่นรายชั่วโมง</th>
                        <th>ราคาโปรโมชั่นรายวัน</th>
                        <th>ราคาโปรโมชั่นรายเดือน</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody id="promotionTableBody">
                    @foreach ($promotions as $promotion)
                        <tr data-id="{{ $promotion->id }}">
                            <td>{{ $promotion->festival_name }}</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ $promotion->hourly_price }}</td>
                            <td>{{ $promotion->daily_price }}</td>
                            <td>{{ $promotion->monthly_price }}</td>
                            <td>{{ $promotion->hourly_discounted }}</td>
                            <td>{{ $promotion->daily_discounted }}</td>
                            <td>{{ $promotion->monthly_discounted }}</td>
                            <td>
                                <button class="edit-btn" onclick="editPromotion({{ $promotion }})">แก้ไข</button>
                                <button class="delete-btn" onclick="deletePromotion({{ $promotion->id }})">ลบ</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // ฟังก์ชันจัดการการส่งข้อมูลฟอร์มด้วย AJAX
        document.getElementById('promotionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่

            const formData = new FormData(this);
            const promotionId = document.getElementById('promotion_id').value;

            // ตรวจสอบว่าเป็นการอัปเดตหรือสร้างใหม่
            const url = promotionId ? `/promotions/${promotionId}` : this.action;

            fetch(url, {
                method: promotionId ? 'PUT' : 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (promotionId) {
                        // อัปเดตรายการโปรโมชันในตาราง
                        updatePromotionInList(data.promotion);
                    } else {
                        // เพิ่มโปรโมชันใหม่ลงในตาราง
                        addPromotionToList(data.promotion);
                    }
                    // เคลียร์ฟอร์ม
                    document.getElementById('promotionForm').reset();
                    document.getElementById('promotion_id').value = ''; // Reset hidden field
                } else {
                    console.error('Error in saving the promotion.');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // ฟังก์ชันเพิ่มโปรโมชันใหม่ลงในตาราง
        function addPromotionToList(promotion) {
            const tableBody = document.getElementById('promotionTableBody');
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', promotion.id);
            newRow.innerHTML = `
                <td>${promotion.festival_name}</td>
                <td>${promotion.start_date}</td>
                <td>${promotion.end_date}</td>
                <td>${promotion.hourly_price}</td>
                <td>${promotion.daily_price}</td>
                <td>${promotion.monthly_price}</td>
                <td>${promotion.hourly_discounted}</td>
                <td>${promotion.daily_discounted}</td>
                <td>${promotion.monthly_discounted}</td>
                <td>
                    <button class="edit-btn" onclick="editPromotion(${JSON.stringify(promotion)})">แก้ไข</button>
                    <button class="delete-btn" onclick="deletePromotion(${promotion.id})">ลบ</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        }

        // ฟังก์ชันอัปเดตรายการโปรโมชันในตาราง
        function updatePromotionInList(promotion) {
            const row = document.querySelector(`tr[data-id="${promotion.id}"]`);
            row.innerHTML = `
                <td>${promotion.festival_name}</td>
                <td>${promotion.start_date}</td>
                <td>${promotion.end_date}</td>
                <td>${promotion.hourly_price}</td>
                <td>${promotion.daily_price}</td>
                <td>${promotion.monthly_price}</td>
                <td>${promotion.hourly_discounted}</td>
                <td>${promotion.daily_discounted}</td>
                <td>${promotion.monthly_discounted}</td>
                <td>
                    <button class="edit-btn" onclick="editPromotion(${JSON.stringify(promotion)})">แก้ไข</button>
                    <button class="delete-btn" onclick="deletePromotion(${promotion.id})">ลบ</button>
                </td>
            `;
        }

        // ฟังก์ชันแก้ไขโปรโมชัน
        function editPromotion(promotion) {
            document.getElementById('festival_name').value = promotion.festival_name;
            document.getElementById('start_date').value = promotion.start_date;
            document.getElementById('end_date').value = promotion.end_date;
            document.getElementById('hourly_price').value = promotion.hourly_price;
            document.getElementById('daily_price').value = promotion.daily_price;
            document.getElementById('monthly_price').value = promotion.monthly_price;
            document.getElementById('discount_percentage').value = (promotion.hourly_price - promotion.hourly_discounted) / promotion.hourly_price * 100;

            // เลื่อนหน้าจอขึ้นไปด้านบน
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // ตั้งค่า ID ของโปรโมชันที่จะแก้ไข
            document.getElementById('promotion_id').value = promotion.id;
        }

        // ฟังก์ชันลบโปรโมชัน
        function deletePromotion(id) {
            if (confirm('คุณแน่ใจหรือว่าต้องการลบโปรโมชันนี้?')) {
                fetch(`/promotions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // ลบแถวโปรโมชันออกจากตาราง
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        row.remove();
                    } else {
                        console.error('Error in deleting the promotion.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>
