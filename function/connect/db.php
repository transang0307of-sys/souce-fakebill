<?php
$localhost_db = 'mysql.railway.internal';
$username_db  = 'root';
$password_db  = 'bNfBDgkYBcxYPNbsxHIHEbXvzkDIeHIX';
$database_db  = 'railway';
$port_db      = 3306;

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
