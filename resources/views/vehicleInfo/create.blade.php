<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลรถใหม่</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('carinfo.css') }}">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
</head>

<body>

    <div class="sidebar">
        <div class="container">
            <!-- รูปภาพผู้ใช้อยู่ข้างบน -->
            <div class="profile-image-container">
                <div class="profile-image" id="profilePreview">
                    <img src="https://via.placeholder.com/120" alt="Profile Image">
                </div>
            </div>
            <p>{{ $user->email }}</p>
            <ul>
                <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</a></li>
                <li><a href="{{ route('vehicle.index') }}"><i class="fas fa-car"></i> ข้อมูลรถของคุณ</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <h1>เพิ่มข้อมูลรถใหม่</h1>
        <form action="{{ route('vehicle.store') }}" method="POST">
            @csrf
            <label for="license_plate">เลขทะเบียนรถ</label>
            <input type="text" id="license_plate" name="license_plate" placeholder="กรอกเลขทะเบียนรถของคุณ" required>
            <br>

            <!-- จังหวัด -->
            <label for="province">เลือกจังหวัด</label>
            <select id="province" name="province" required>
                <option value="" disabled selected>เลือกจังหวัด</option>
                <!-- ภาคเหนือ -->
                <optgroup label="ภาคเหนือ">
                    <option value="เชียงใหม่">เชียงใหม่</option>
                    <option value="เชียงราย">เชียงราย</option>
                    <option value="ลำพูน">น่าน </option>
                    <option value="พะเยา">พะเยา</option>
                    <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                    <option value="แพร่">แพร่</option>
                    <option value="ลำปาง">ลำปาง</option>
                    <option value="ลำพูน">ลำพูน</option>
                    <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                </optgroup>
                <!-- ภาคกลาง -->
                <optgroup label="ภาคกลาง">
                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                    <option value="กำแพงเพชร"> กำแพงเพชร</option>
                    <option value="ชัยนาท">ชัยนาท</option>
                    <option value="นครนายก">นครนายก</option>
                    <option value="นครปฐม">นครปฐม</option>
                    <option value="นครสวรรค์">นครสวรรค์</option>
                    <option value="นนทบุรี"> นนทบุรี</option>
                    <option value="ปทุมธานี"> ปทุมธานี</option>
                    <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                    <option value="พิจิตร">พิจิตร</option>
                    <option value="พิษณุโลก">พิษณุโลก</option>
                    <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                    <option value="ลพบุรี">ลพบุรี</option>
                    <option value="สมุทรปราการ">สมุทรปราการ</option>
                    <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                    <option value="สมุทรสาคร">สมุทรสาคร</option>
                    <option value="สระบุรี">สระบุรี</option>
                    <option value="สิงห์บุรี">สิงห์บุรี</option>
                    <option value="	สุโขทัย">สุโขทัย</option>
                    <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                    <option value="	อ่างทอง">อ่างทอง</option>
                    <option value="	อุทัยธานี"> อุทัยธานี</option>
                    <!-- เพิ่มจังหวัดอื่นๆ ในภาคกลางได้ตามต้องการ -->
                </optgroup>
                <!-- ภาคอีสาน -->
                <optgroup label="ภาคตะวันออกเฉียงเหนือ">
                    <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                    <option value="ขอนแก่น">ขอนแก่น</option>
                    <option value="ชัยภูมิ">ชัยภูมิ</option>
                    <option value="	นครพนม">นครพนม</option>
                    <option value="	นครราชสีมา">นครราชสีมา</option>
                    <option value="บึงกาฬ">บึงกาฬ</option>
                    <option value="	บุรีรัมย์"> บุรีรัมย์</option>
                    <option value="มหาสารคาม">มหาสารคาม</option>
                    <option value="	มุกดาหาร"> มุกดาหาร</option>
                    <option value="ยโสธร">ยโสธร</option>
                    <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                    <option value="เลย">เลย</option>
                    <option value="	ศรีสะเกษ">ศรีสะเกษ</option>
                    <option value="	สกลนคร">สกลนคร</option>
                    <option value="	สุรินทร์"> สุรินทร์</option>
                    <option value="หนองคาย">หนองคาย</option>
                    <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                    <option value="อุดรธานี">อุดรธานี</option>
                    <option value="อุบลราชธานี">อุบลราชธานี</option>
                    <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                </optgroup>
                <!-- ภาคตะวันออก -->
                <optgroup label="ภาคตะวันออก">
                    <option value="จันทบุรี">จันทบุรี</option>
                    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                    <option value="ชลบุรี">ชลบุรี</option>
                    <option value="ตราด">ตราด</option>
                    <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                    <option value="	ระยอง">ระยอง</option>
                    <option value="สระแก้ว">สระแก้ว</option>
                </optgroup>
                <!-- ภาคตะวันตก -->
                <optgroup label="ภาคตะวันตก">
                    <option value="กาญจนบุรี">กาญจนบุรี</option>
                    <option value="ตาก">ตาก</option>
                    <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                    <option value="เพชรบุรี">เพชรบุรี</option>
                    <option value="ราชบุรี">ราชบุรี</option>
                </optgroup>
                <!-- ภาคใต้ -->
                <optgroup label="ภาคใต้">
                    <option value="กระบี่">กระบี่</option>
                    <option value="ชุมพร">ชุมพร</option>
                    <option value="ตรัง">ตรัง</option>
                    <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                    <option value="นราธิวาส">นราธิวาส</option>
                    <option value="ปัตตานี">ปัตตานี</option>
                    <option value="พังงา">พังงา</option>
                    <option value="	พัทลุง">พัทลุง</option>
                    <option value="ภูเก็ต">ภูเก็ต</option>
                    <option value="ยะลา">ยะลา</option>
                    <option value="	ระนอง"> ระนอง</option>
                    <option value="	สตูล">สตูล</option>
                    <option value="สงขลา">สงขลา</option>
                    <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                </optgroup>
            </select>
            <br>

            <label>เลือกประเภทรถ</label>
            <div class="checkbox-group">
                <label><input type="radio" name="vehicle_type" value="รถยนต์" required> รถยนต์</label>
                <label><input type="radio" name="vehicle_type" value="มอเตอร์ไซค์" required> มอเตอร์ไซค์</label>
            </div>
            <br>

            <button type="submit">บันทึกข้อมูล</button>
        </form>
        <a href="{{ route('vehicle.index') }}">กลับไปหน้าหลัก</a>
    </div>
</body>

</html>
