@extends('admin.layouts.sidebar')

@section('title', 'เพิ่มสถานที่จอดรถ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-parking-spot.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>เพิ่มช่องจอดรถ</h1>
        <form method="POST"
            action="{{ isset($spotToEdit) ? route('admin.parking-spots.update', $spotToEdit['id']) : route('admin.parking-spots.store') }}"
            id="floorForm">
            @csrf
            @if (isset($spotToEdit))
                @method('PUT')
            @endif

            <label for="spot_number">ชื่อช่องจอดรถ:</label>
            <input type="text" id="spot_number" name="spot_number" placeholder="ระบุชื่อช่องจอดรถ"
                value="{{ isset($spotToEdit) ? $spotToEdit['name'] : '' }}" required>
            <div class="select-dropdown">
                <label for="floor_id">ชั้นที่:</label>
                <select id="floor_id" name='floor_id'>
                    @foreach ($floors as $floor)
                        <option value="{{ $floor['id'] }}">{{ $floor['name'] . ' - Floor: ' . $floor['floor'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="select-dropdown">
                <label for="is_available">สถานะ:</label>
                <select id="is_available" name='is_available'>
                    <option value="1">ว่าง</option>
                    <option value="0">ไม่ว่าง</option>
                </select>
            </div>
            <div class="select-dropdown">
                <label for="spot_type">ประเภท:</label>
                <select id="spot_type" name='spot_type'>
                    <option value="รถยนต์">รถยนต์</option>
                    <option value="มอเตอรไซต์">มอเตอรไซต์</option>
                </select>
            </div>
            <input id="input-form-submit" type="submit" value="บันทึกข้อมูล">
        </form>
    </div>

    <div class="container">
        @foreach ($floors as $floor)
            <h3>ชั้นที่: {{ $floor['floor'] . ' ' }} ({{ $floor['name'] }})</h3>
            <div class="spot-table">
                @foreach ($floor['spots'] as $spot)
                    <div class="spot-item {{ $spot['spot_type'] == 'รถยนต์' ? 'spot-item-cars' : 'spot-item-motorcycle' }} {{ $spot['is_available'] ? 'spot-item-available' : 'spot-item-unavailable' }}"
                        onclick="editSpot({{ json_encode($spot) }}, {{ json_encode($floor) }})">
                        <span>{{ $spot['spot_number'] }}</span>
                        <img class='spot-item-img'
                            src="{{ $spot['spot_type'] == 'รถยนต์' ? asset('/car_icon.png') : asset('/motorcycle_icon.png') }}"
                            alt="">
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <script>
        function confirmDelete() {
            return confirm('คุณแน่ใจหรือว่าต้องการลบสถานที่จอดนี้?');
        }

        function editSpot(spot, floor) {
            alert('กำลังแก้ไขช่องที่จอดรถ: ' + spot['spot_number']);

            const spotNumber = document.getElementById('spot_number');
            const floorSelect = document.getElementById('floor_id');
            const isAvailableSelect = document.getElementById('is_available');
            const spotTypeSelect = document.getElementById('spot_type');

            spotNumber.value = spot['spot_number'];
            Array.from(floorSelect.options).forEach(option => {
                option.selected = option.value == floor['id'];
            });
            Array.from(isAvailableSelect.options).forEach(option => {
                option.selected = option.value == spot['is_available'];
            });
            Array.from(spotTypeSelect.options).forEach(option => {
                option.selected = option.value == spot['spot_type'];
            });


            const form = document.getElementById('floorForm');
            form.action = `/admin/parking-spots/${spot['id']}`;
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
@endsection
