<!-- user_parking.blade.php -->
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .parking-container {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 10px;
            margin: 40px 50px;
        }

        .parking {
            background-color: #2ECC71;
            /* Green background for available parking */
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            position: relative;
            width: 70px;
            height: 80px;
            font-size: 25px;
        }

        .parking button {
            background-color: #FFFFFF;
            border: none;
            padding: 5px 15px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 23px;
        }

        .parking button:hover {
            border: 2px solid #F5F5F7;
            background-color: #F5F5F7;
        }

        .parking.selected {
            background-color: #E74C3C;
            /* Red background for unavailable parking */
        }

        .parking.unavailable {
            background-color: #BDC3C7;
            /* Gray background for unavailable parking */
            cursor: not-allowed;
        }

        .floor-selector label {
            font-size: 20px;
            font-family: 'TH Sarabun New', sans-serif;
            color: #333;
            margin-right: 10px;
        }

        .floor-selector select {
            font-size: 18px;
            padding: 8px 12px;
            border-radius: 10px;
            border: 2px solid #333;
            background-color: #FFFFFF;
            width: 70px;
            cursor: pointer;
        }

        

        .parking-summary p {
            font-size: 25px;
            margin: 8px 0;
            background-color: #DDDDDD;
            margin-right: 1000px;
            margin-left: 50px;
            padding: 15px;
            text-align: center;
            border-radius: 20px;

        }
        
    </style>
</head>

<body>
  
    <div class="main-content">
        <div class="floor-selector">
            <label for="floorSelect">ชั้น: </label>
            <select id="floorSelect" onchange="showFloor(this.value)">
                <option value="1"> 1</option>
                <option value="2"> 2</option>
                <option value="3"> 3</option>
            </select>
        </div>

        <div id="parkingContainer1" class="parking-container" data-floor="1">
            @for ($i = 1; $i <= 32; $i++)
                <div class="parking" id="A{{ $i }}" data-status="available">
                A{{ $i }}
                <form action="{{ route('user.bookParking', ['id' => 'A'.$i]) }}" method="POST" onsubmit="return toggleParking(this);">
    @csrf
    <button type="submit" class="available">ว่าง</button>
</form>

            </div>
            @endfor
        </div>

        <div id="parkingContainer2" class="parking-container" data-floor="2" style="display: none;">
            @for ($i = 1; $i <= 32; $i++)
                <div class="parking" id="B{{ $i }}" data-status="available">
                B{{ $i }}
                <form action="{{ route('user.bookParking', ['id' => 'A'.$i]) }}" method="POST" onsubmit="return toggleParking(this);">
    @csrf
    <button type="submit" class="available">ว่าง</button>
</form>

            </div>
            @endfor
        </div>

        <div id="parkingContainer3" class="parking-container" data-floor="3" style="display: none;">
            @for ($i = 1; $i <= 32; $i++)
                <div class="parking" id="C{{ $i }}" data-status="available">
                C{{ $i }}
                <form action="{{ route('user.bookParking', ['id' => 'A'.$i]) }}" method="POST" onsubmit="return toggleParking(this);">
    @csrf
    <button type="submit" class="available">ว่าง</button>
</form>

            </div>
            @endfor
        </div>

    <div class="parking-summary">
        <p>ที่ว่าง: {{ $availableCount }}</p>
        <p>ไม่ว่าง: {{ $unavailableCount }}</p>
    </div>
    </div>

    <script>
        function toggleParking(form) {
            const parkingDiv = form.parentElement;
            const status = parkingDiv.getAttribute('data-status');

            if (status === 'available') {
                parkingDiv.setAttribute('data-status', 'unavailable');
                parkingDiv.classList.add('selected');
                parkingDiv.querySelector('button').innerText = 'ไม่ว่าง';
                parkingDiv.querySelector('button').classList.add('unavailable');
            } else {
                parkingDiv.setAttribute('data-status', 'available');
                parkingDiv.classList.remove('selected');
                parkingDiv.querySelector('button').innerText = 'ว่าง';
                parkingDiv.querySelector('button').classList.remove('unavailable');
            }

            // อัปเดตจำนวนที่ว่างและไม่ว่าง
            const currentFloor = document.querySelector('#floorSelect').value;
            showFloor(currentFloor);

            return false; // Prevent form submission
        }

        function showFloor(floor) {
            const containers = document.querySelectorAll('.parking-container');
            containers.forEach(container => {
                container.style.display = container.getAttribute('data-floor') === floor ? 'grid' : 'none';
            });

            // นับจำนวนที่จอดรถที่ว่างและไม่ว่าง
            const selectedFloorContainer = document.querySelector(`.parking-container[data-floor="${floor}"]`);
            const availableParkings = selectedFloorContainer.querySelectorAll('.parking[data-status="available"]').length;
            const unavailableParkings = selectedFloorContainer.querySelectorAll('.parking[data-status="unavailable"]').length;

            // อัปเดตจำนวนที่ว่างและไม่ว่าง
            document.querySelector('.parking-summary').innerHTML = `
                <p>ที่ว่าง: ${availableParkings}</p>
                <p>ไม่ว่าง: ${unavailableParkings}</p>
            `;
        }

        // เริ่มต้นการแสดงผลให้แสดงชั้นแรก
        showFloor('1');
    </script>
</body>

</html>