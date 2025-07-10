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
$filterMonth = isset($_POST['filterMonth']) ? trim($_POST['filterMonth']) : '';

// convert date
$month = date('Y-m', strtotime($filterMonth));

// count total penjualan
$sql = mysqli_query($conn, "SELECT SUM(c_weight) AS total_kg, SUM(c_price) AS total_harga FROM t_stock WHERE c_user='$c_user' AND c_date LIKE '$month%' AND c_status='keluar'");
$penjualan_kg = 0;
$penjualan_harga = 0;
if ($sql && mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $penjualan_kg = $row['total_kg'] ? $row['total_kg'] : 0;
    $penjualan_harga = $row['total_harga'] ? $row['total_harga'] : 0;
}   

// count total pembelian
$sql = mysqli_query($conn, "SELECT SUM(c_weight) AS total_kg, SUM(c_price) AS total_harga FROM t_stock WHERE c_user='$c_user' AND c_date LIKE '$month%' AND c_status='masuk'");
$pembelian_kg = 0;
$pembelian_harga = 0;
if ($sql && mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $pembelian_kg = $row['total_kg'] ? $row['total_kg'] : 0;
    $pembelian_harga = $row['total_harga'] ? $row['total_harga'] : 0;
}

echo json_encode([
    'status' => 'success',
    'penjualan_kg' => $penjualan_kg,
    'penjualan_harga' => $penjualan_harga,
    'pembelian_kg' => $pembelian_kg,
    'pembelian_harga' => $pembelian_harga
]);


$conn->close();
