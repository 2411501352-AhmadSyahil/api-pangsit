<?php
header("Content-Type: application/json");
include 'database.php';

// Menangkap data dari Android
$nama = $_POST['nama'] ?? '';
$noHp = $_POST['noHp'] ?? '';
$email = $_POST['email'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$jenisPangsit = $_POST['jenisPangsit'] ?? '';
$levelPedas = $_POST['levelPedas'] ?? '';
$jumlah = $_POST['jumlah'] ?? '';
$totalHarga = $_POST['totalHarga'] ?? '';

// Validasi input
if(empty($nama) || empty($email) || empty($jumlah)) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap!"]);
    exit;
}

// Memasukkan data ke database
$sql = "INSERT INTO orders (nama, noHp, email, alamat, jenisPangsit, levelPedas, jumlah, totalHarga) 
        VALUES ('$nama', '$noHp', '$email', '$alamat', '$jenisPangsit', '$levelPedas', '$jumlah', '$totalHarga')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Pesanan berhasil ditambahkan!"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal menyimpan data: " . $conn->error]);
}

$conn->close();
?>