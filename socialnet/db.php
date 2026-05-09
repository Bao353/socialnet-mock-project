<?php
$host = 'localhost';
$dbname = 'socialnet';
$user = 'root';
$pass = '123456';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
