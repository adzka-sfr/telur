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
$id = isset($_POST['id']) ? trim($_POST['id']) : '';

// check if id is still available in database
$sql = mysqli_query($conn, "SELECT COUNT(*) AS total FROM t_stock WHERE id='$id'");
$data = mysqli_fetch_array($sql);
if ($data['total'] > 0) {
    // delete data from t_stock
    $delete = mysqli_query($conn, "DELETE FROM t_stock WHERE id='$id' AND c_user='$c_user'");
    if ($delete) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Transaksi berhasil dihapus.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal menghapus transaksi. Silakan coba lagi.'
        ]);
    }
}else{
    echo json_encode(array(
        'status' => 'not-found',
        'message' => 'Transaksi tidak ditemukan atau sudah dihapus.'
    ));
}

$conn->close();
