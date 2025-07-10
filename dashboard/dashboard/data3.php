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

?>
<table class="table table-bordered" style="font-size: 12px; width: 100%;">
    <thead style="text-align: center;">
        <tr>
            <th></th>
            <th>Tanggal</th>
            <th>Orang</th>
            <th>Status</th>
            <th>Kg</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // get data transaksi
        $sql = mysqli_query($conn, "SELECT * FROM t_stock WHERE c_user='$c_user' AND c_date LIKE '$month%'");
        if ($sql && mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
        ?>
                <tr>
                    <td style="text-align: center;" onclick="hapusTransaksi(<?= $row['id']; ?>, '<?= htmlspecialchars($row['c_person']); ?>','<?= htmlspecialchars($row['c_date']); ?>', '<?= htmlspecialchars($row['c_weight']); ?>', '<?= htmlspecialchars($row['c_status']); ?>', '<?= htmlspecialchars($row['c_price']); ?>')">
                        <i class="fas fa-minus-circle" style="color: #dc3545; margin-left: 5px;"></i>
                    </td>
                    <td><?php echo date('d M Y', strtotime($row['c_date'])); ?></td>
                    <td style="text-align: left;"><?php echo htmlspecialchars($row['c_person']); ?></td>
                    <td><?php echo htmlspecialchars($row['c_status']); ?></td>
                    <td><?php echo htmlspecialchars($row['c_weight']); ?> Kg</td>
                    <td>Rp. <?php echo number_format($row['c_price'], 0, ',', '.'); ?></td>
                </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="6" style="text-align: center;">Tidak ada data transaksi untuk bulan ini.</td></tr>';
        }
        ?>
    </tbody>
</table>
<?php


$conn->close();
