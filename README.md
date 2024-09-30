### Installation

1. ติดตั้ง package laravel
    > composer install
2. ติดตั้ง node package
    > npm install
3. migrate ตาราง (อย่าลืมแก้ .env)
    > php artisan migrate

<br>
**** อย่าใช้ branch main แก้โค้ด <br>
**** ให้สร้าง branch จาก main ตั้งชื่อของใครของมัน เเล้วแก้ให้เสร็จในส่วนของตัวเอง<br>
**** เสร็จเเล้วสร้าง pull request บน github merge branch ตัวเองเข้า main<br>
**** ถ้ามี conflict ถามพี่ตั้ง !!!! (เผื่อพี่หลับอยู่)<br>
<br>

### อธิบายโครงสร้าง project

1. ฝั่งของ user
    - route ที่ routes/web.php
    - controller ที่ app/Http/Controllers/
    - view ที่ resources/views/
2. ฝั่งของ admin
    - route ที่ routes/admin.php
    - controller ที่ app/Http/Controllers/Admin/
    - view ที่ resources/views/admin/

<br>

### ส่วนที่ยังไม่เสร็จ

-   user dashboard กด submit เเล้วไม่ส่ง request
-   parking spot ไม่เข้าใจ logic ของโค้ดที่ส่งมา ทำไม design ตารางแบบนั้น เเละไม่รู้จะใช้ model ไหน
-   layout dashboard ทั้ง user กับ admin ยังไม่เพิ่ม เพราะพี่ไม่เห็นโค้ด sidebar.blade
-   admin register ได้ โดยไม่ต้อง confirm กับ super-user เลย (อ้างว่าทำไม่ทันก็ได้) ถ้าจะแก้ทักมาถามพี่อีกที
-   เส้น profile ของ user ดู url ใน routes/auth.php เผื่อจะเอาไปใส่ใน sidebar
-   เส้น profile ของ admin ดู url ใน routes/admin/auth.php เผื่อจะเอาไปใส่ใน sidebar
