<?php
$config = [
    'server'   => 'dpg-d9eqe5b7uimc73a73010-a.oregon-postgres.render.com', // Hoặc dùng 'dpg-d9eqe5b7uimc73a73010-a' nếu chạy chung trên Render
    'port'     => '5432',
    'username' => 'billviet_user',
    'password' => 'Zx0WVFiKfPO1dxgRhy140kyvuHd59tMe',
    'database' => 'billviet',
];

// Hàm hỗ trợ tạo chuỗi kết nối cho PostgreSQL
$conn_string = "host={$config['server']} port={$config['port']} dbname={$config['database']} user={$config['username']} password={$config['password']} sslmode=require";

$conn = pg_connect($conn_string);

if (!$conn) {
    die("Lỗi kết nối đến Render Database!");
}
?>
