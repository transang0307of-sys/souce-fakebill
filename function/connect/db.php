<?php
$localhost_db = 'mysql-3f4b73e7-transang0307of-e326.d.aivencloud.com';
$username_db  = 'avnadmin';
$password_db  = 'AVNS_J9V2kgQz6u--1f44ZMR';
$database_db  = 'defaultdb';
$port_db      = 16996;

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
