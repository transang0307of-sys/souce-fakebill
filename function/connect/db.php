<?php
$localhost_db = 'mysql-3f4b73e7-transang0307of-e326.d.aivencloud.com';
$username_db  = 'avnadmin';
$password_db  = 'AVNS_J9V2kgQz6u--1f44ZMR';
$database_db  = 'defaultdb';
$port_db      = 16996;

// 1. Khởi tạo mysqli
$conn = mysqli_init();

if (!$conn) {
    die("Lỗi khởi tạo mysqli");
}

// 2. Bắt buộc bật SSL cho Aiven (không bắt buộc verify cert để tránh lỗi cert tự ký)
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// 3. Thực hiện kết nối kèm SSL
$connected = mysqli_real_connect(
    $conn,
    $localhost_db,
    $username_db,
    $password_db,
    $database_db,
    $port_db,
    NULL,
    MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT
);

if (!$connected) {
    die("Lỗi kết nối CSDL: " . mysqli_connect_error());
}

// 4. Thiết lập charset utf8mb4
mysqli_set_charset($conn, "utf8mb4");
