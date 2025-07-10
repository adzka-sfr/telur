<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <input type="month" class="form-control" id="filterMonth" name="filterMonth" onchange="getTotalPenjualanPembelian()" value="<?php echo date('Y-m'); ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Pembelian
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-12">
                        <h1 style="font-size: 3em;"><span id="pembelian_kg"></span><sub>Kg</sub></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span>Rp. <span id="pembelian_harga"></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-header">
                Penjualan
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-12">
                        <h1 style="font-size: 3em;"><span id="penjualan_kg"></span><sub>Kg</sub></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span>Rp. <span id="penjualan_harga"></span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 text-center mt-3">
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#transaksiModal">
            Tambah transaksi
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12" id="dataTable">

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaksiModalLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="transaksiForm">
                    <div class="row align-items-end">
                        <div class="col-md-12 mb-2">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stockStatus" id="stockIn" value="keluar" required>
                                <label class="form-check-label" for="stockIn">Penjualan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stockStatus" id="stockOut" value="masuk" required>
                                <label class="form-check-label" for="stockOut">Pembelian</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="stockDate" class="form-label">Tanggal</label>
                            <input type="datetime-local" class="form-control" id="stockDate" name="stockDate"
                                value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="stockAmount" class="form-label">Jumlah</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="stockAmount" name="stockAmount" min="1" aria-describedby="basic-addon2" required>
                                <span class="input-group-text" id="basic-addon2">Kg</span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="price" class="form-label">Total Pembayaran</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" form="transaksiForm" class="btn btn-primary" id="btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        getTotalPenjualanPembelian();

    });

    // function to get total penjualan dan total pembelian
    function getTotalPenjualanPembelian() {
        var filterMonth = $('#filterMonth').val();
        $.ajax({
            url: 'dashboard/data2.php',
            type: 'POST',
            data: {
                filterMonth: filterMonth
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    $('#penjualan_kg').text(data.penjualan_kg);
                    $('#pembelian_kg').text(data.pembelian_kg);
                    $('#penjualan_harga').text(Number(data.penjualan_harga).toLocaleString('id-ID'));
                    $('#pembelian_harga').text(Number(data.pembelian_harga).toLocaleString('id-ID'));
                    getDataTable();

                } else if (data.status === 'not_logged_in') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: data.message,
                    }).then(() => {
                        // load current page to force login
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan transaksi!',
                });
            }
        });
    }

    // function to get data in table
    function getDataTable() {
        var filterMonth = $('#filterMonth').val();
        $.ajax({
            url: 'dashboard/data3.php',
            type: 'POST',
            data: {
                filterMonth: filterMonth
            },
            success: function(response) {
                $('#dataTable').html(response);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan transaksi!',
                });
            }
        });
    }

    // button simpan click event throw data to data1.php using ajax
    $('#btn-simpan').click(function() {
        var nama = $('#name').val();
        var tanggal = $('#stockDate').val();
        var jumlahKg = $('#stockAmount').val();
        var statusBarang = $('input[name="stockStatus"]:checked').val();
        var harga = $('#price').val();

        // Validasi input
        if (!nama || !tanggal || !jumlahKg || !statusBarang || !harga) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Semua input harus diisi!',
            });
            return;
        }

        $.ajax({
            url: 'dashboard/data1.php',
            type: 'POST',
            data: {
                nama: nama,
                tanggal: tanggal,
                jumlahKg: jumlahKg,
                statusBarang: statusBarang,
                harga: harga
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                    }).then(() => {
                        // close modal
                        $('#transaksiModal').modal('hide');
                        // reset form
                        $('#transaksiForm')[0].reset();
                        // reload data
                        getTotalPenjualanPembelian();
                        // reload table data
                        getDataTable();
                    });
                } else if (data.status === 'not_logged_in') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: data.message,
                    }).then(() => {
                        // load current page to force login
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menyimpan transaksi!',
                });
            }
        });
    });

    // function to delete transaction
    function hapusTransaksi(id, nama, tanggal, jumlahKg, statusBarang, harga) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `
                <table class="table table-bordered text-start">
                    <tr>
                        <th>Nama</th>
                        <td>${nama}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>${tanggal}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>${jumlahKg} Kg</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>${statusBarang === 'masuk' ? 'Pembelian' : 'Penjualan'}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp. ${Number(harga).toLocaleString('id-ID')}</td>
                    </tr>
                </table>
                <div class="text-danger mt-2">Transaksi akan dihapus secara permanen!</div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'dashboard/data4.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire(
                                'Dihapus!',
                                data.message,
                                'success'
                            );
                            getTotalPenjualanPembelian();
                            getDataTable();
                        } else if (data.status === 'not-found') {
                            Swal.fire(
                                'Tidak Ditemukan!',
                                data.message,
                                'warning'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus transaksi!',
                            'error'
                        );
                    }
                });
            }
        });

    }
</script>