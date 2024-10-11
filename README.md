### Installation

1. ติดตั้ง package laravel
    > composer install
2. ติดตั้ง node package
    > npm install
3. สร้าง APP_KEY ใหม่
    > php artisan key:generate
4. migrate ตาราง (อย่าลืมแก้ database ใน .env)
    > php artisan migrate
5. Seed ข้อมูลช่องจอดรถ
    > php artisan db:seed --class=ParkingSpotDefualtSeeder

<br>
**** อย่าใช้ branch main แก้โค้ด <br>
**** ให้สร้าง branch จาก main ตั้งชื่อของใครของมัน เเล้วแก้ให้เสร็จในส่วนของตัวเอง<br>
**** เสร็จเเล้วสร้าง pull request บน github merge branch ตัวเองเข้า main<br>
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

### รวมคำสั่งใช้บ่อย

-   สร้างไฟล์ migration table

    > php artisan make:migration <create/alter/remove_table_name>

    เช่น <br>
    create_promotions_table,<br>
    alter_promotions_table_add_created_by_column,<br>
    alter_promotions_table_change_type_of_created_by_column<br>

-   migrate table ลง database
    > php artisan migrate
