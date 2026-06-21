<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

$host = getenv('MYSQLHOST') ?: getenv('DB_HOST');
$user = getenv('MYSQLUSER') ?: getenv('DB_USER');
$pass = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS');
$db   = getenv('MYSQLDATABASE') ?: getenv('DB_NAME');
$port = getenv('MYSQLPORT') ?: 3306;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Koneksi gagal: " . $conn->connect_error]);
    exit;
}

$path = $_SERVER['REQUEST_URI'];

if (strpos($path, '/create_order') !== false && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $noHp = $_POST['noHp'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $jenisPangsit = $_POST['jenisPangsit'] ?? '';
    $levelPedas = $_POST['levelPedas'] ?? '';
    $jumlah = $_POST['jumlah'] ?? '';
    $totalHarga = $_POST['totalHarga'] ?? '';

    if(empty($nama) || empty($noHp) || empty($jumlah)) {
        echo json_encode(["success" => false, "message" => "Data tidak lengkap!"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO orders (nama, noHp, email, alamat, jenisPangsit, levelPedas, jumlah, totalHarga) VALUES (?, ?, '', ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nama, $noHp, $alamat, $jenisPangsit, $levelPedas, $jumlah, $totalHarga);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Pesanan berhasil ditambahkan!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal: " . $stmt->error]);
    }
    $stmt->close();

} elseif (strpos($path, '/test') !== false) {
    echo json_encode(["success" => true, "message" => "Server menyala!"]);

} else {
    echo json_encode(["success" => true, "message" => "Pangsit Chili Oil API Running!"]);
}

$conn->close();
