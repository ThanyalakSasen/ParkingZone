### Installation

1. ติดตั้ง package laravel
    > composer install
2. ติดตั้ง node package
    > npm install
3. migrate ตาราง (อย่าลืมแก้ .env)
    > php artisan migrate
4. สร้าง APP_KEY ใหม่
    > php artisan key:generate

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

-   layout dashboard ทั้ง user กับ admin ยังไม่เพิ่ม [May be ครีม]
-   หน้าเลือก promotion สำหรับ user หลังจากเลือก parking spot [พลอย]
-   หน้า ข้อมูลรถของคุณ สำหรับ user - [แบม]
-   หน้า ข้อมูลส่วนตัว สำหรับ user - [ขนุน]
-   หน้า ประวัติการจอง สำหรับ user - [แบม]

<br>

### ฝากคอมเม้น

-   admin register ได้ โดยไม่ต้อง confirm กับ super-user เลย (อ้างว่าทำไม่ทันก็ได้) ถ้าจะแก้ทักมาถามพี่อีกที
-   เส้น profile ของ user ดู url ใน routes/web.php เผื่อจะเอาไปใส่ใน sidebar
-   เส้น profile ของ admin ดู url ใน routes/admin/auth.php เผื่อจะเอาไปใส่ใน sidebar
-   ใน admin.php จะมี ->prefix('admin') ไว้ หมายความว่า url ที่ประกาศจะขึ้นต้นด้วย /admin/<url ที่ประกาศใน route>

<br>

### รวมคำสั่งใช้บ่อย

-   สร้างไฟล์ migration table

    > php artisan make:migration <create/alter/remove_table_name>

    เช่น <br>
    create_promotions_table,<br>
    alter_promotions_table_add_created_by_column,<br>
    alter_promotions_table_change_type_of_created_by_column<br>

-   migrate table ลง database
    > php artisan migrate
