<?php
include '../../config.php';
// Check if the user is logged in
if (!isset($_SESSION['sb_id'])) {
    echo json_encode([
        'status' => 'not_logged_in',
        'message' => 'Silahkan login ulang.'
    ]);
    exit();
}

// Assuming c_user is the user ID from session
$c_user = $_SESSION['sb_id'];

// get data post
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$tanggal = isset($_POST['tanggal']) ? trim($_POST['tanggal']) : '';
$jumlahKg = isset($_POST['jumlahKg']) ? trim($_POST['jumlahKg']) : '';
$statusBarang = isset($_POST['statusBarang']) ? trim($_POST['statusBarang']) : '';
$harga = isset($_POST['harga']) ? trim($_POST['harga']) : '';

// convert date
$stockDate = date('Y-m-d H:i:s', strtotime($tanggal));

// insert to database t_stock using mysqli
if ($nama && $stockDate && $jumlahKg && $statusBarang && $harga) {
    $stmt = $conn->prepare("INSERT INTO t_stock (c_user, c_date, c_person, c_weight, c_status, c_price) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Prepare failed: ' . $conn->error
        ]);
        exit();
    }
    // c_user (int), c_date (string), c_person (string), c_weight (float), c_status (string), c_price (float)
    $stmt->bind_param("issssd", $c_user, $stockDate, $nama, $jumlahKg, $statusBarang, $harga);
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Stock data successfully inserted.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to insert stock data: ' . $stmt->error
        ]);
    }
    $stmt->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input data.'
    ]);
}
$conn->close();
?>