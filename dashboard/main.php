<?php
include "../_header.php";
include "../config.php";

// untuk pengecekan sesi
if (!isset($_SESSION['sb_id'])) {
    echo "<script>window.location='" . base_url('auth/') . "';</script>";
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-box"></i> Items
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="main.php?page=dashboard"><i class="fas fa-home"></i> Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="main.php?page=history"><i class="fas fa-receipt"></i> Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="main.php?page=logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        if (empty($_GET['page'])) {
            $_GET['page'] = "login";
        } else {
            include "content.php";
        }
        ?>
    </div>

    <?php
    include "../_footer.php";
    ?>