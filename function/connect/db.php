<?php
$localhost_db = 'dpg-d9eqe5b7uimc73a73010-a.oregon-postgres.render.com'; // Hoặc 'dpg-d9eqe5b7uimc73a73010-a' nếu chạy web trực tiếp trên Render
$username_db  = 'billviet_user';
$password_db  = 'Zx0WVFiKfPO1dxgRhy140kyvuHd59tMe';
$database_db  = 'billviet';
$port_db      = '5432';

// Chuỗi kết nối đến PostgreSQL trên Render
$conn_string = "host={$localhost_db} port={$port_db} dbname={$database_db} user={$username_db} password={$password_db} sslmode=require";

// Thực hiện kết nối
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Lỗi kết nối đến Render Database!");
}
?>
