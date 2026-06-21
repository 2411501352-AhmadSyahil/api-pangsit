<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pangsit_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>