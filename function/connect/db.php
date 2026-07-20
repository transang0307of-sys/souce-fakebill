<?php
$localhost_db = 'tokaido.proxy.rlwy.net';
$username_db  = 'root';
$password_db  = 'bNfBDgkYBcxYPNbsxHIHEbXvzkDIeHIX';
$database_db  = 'railway';
$port_db      = 24575;

$conn = mysqli_connect(
    $localhost_db,
    $username_db,
    $password_db,
    $database_db,
    $port_db
);

if (!$conn) {
    die("Lỗi kết nối: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
