<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}" sizes="32x32">
    <title>เพิ่มสถานที่จอดรถ</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('parkingLocation.css') }}">
</head>

<body>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session('errors'))
        <div class="error">{{ session('errors') }}</div>
    @endif
    <div class="container">
        <h1>เพิ่มชั้นที่จอดรถ</h1>
        <form method="POST"
            action="{{ isset($locationToEdit) ? route('admin.parking-floors.update', $locationToEdit->id) : route('admin.parking-floors.store') }}"
            id="locationForm">
            @csrf
            @if (isset($locationToEdit))
                @method('PUT')
            @endif

            <label for="name">ชื่อชั้นที่จอดรถ:</label>
            <input type="text" id="name" name="name" placeholder="ระบุชื่อชั้นที่จอดรถ เช่น A, B"
                value="{{ isset($locationToEdit) ? $locationToEdit->name : '' }}" required>

            <label for="floor">ชั้นที่:</label>
            <input type="number" id="floor" name="floor" min="1" max="100" placeholder="1 - 100"
                value="{{ isset($locationToEdit) ? $locationToEdit->floor : '' }}" required>

            <input id="input-form-submit" type="submit" value="บันทึกข้อมูล">
        </form>

        <div class="locations-list">
            <h2>รายการชั้นที่จอดรถ</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ชื่อชั้นที่จอดรถ</th>
                        <th>ชั้นที่</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($floors as $floor)
                        <tr>
                            <td>{{ $floor->id }}</td>
                            <td>{{ $floor->name }}</td>
                            <td>{{ $floor->floor }}</td>
                            <td>
                                <div>
                                    <button class="manage-btn edit"
                                        onclick="editLocation({{ $floor }})">แก้ไข</button>
                                    <form method="POST"
                                        action="{{ route('admin.parking-floors.destroy', $floor->id) }}"
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
            return confirm('คุณแน่ใจหรือว่าต้องการลบสถานที่จอดนี้?');
        }

        function editLocation(location) {
            alert('กำลังแก้ไขสถานที่จอด: ' + location.name);

            const name = document.getElementById('name');
            const floor = document.getElementById('floor');
            name.value = location.name;
            floor.value = parseInt(location.floor);

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            const form = document.getElementById('locationForm');
            form.action = `/admin/parking-floors/${location.id}`;
            form.method = 'POST';

            const inputSubmit = document.getElementById('input-form-submit');
            inputSubmit.value = 'อัปเดตข้อมูล';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_method';
            csrfInput.value = 'PUT';
            form.appendChild(csrfInput);
        }
    </script>
</body>

</html>
