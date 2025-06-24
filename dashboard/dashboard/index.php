<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Stok
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-12">
                        <h1 style="font-size: 3em;" id="show-kg">300<sub>Kg</sub></h1>
                        <h1 style="font-size: 3em; display: none;" id="show-gram">300000<sub>Gram</sub></h1>
                        <h1 style="font-size: 3em; display: none;" id="show-ons">30<sub>Ons</sub></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="unit" id="unitKg" value="kg" checked>
                            <label class="form-check-label" for="unitKg">Kg</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="unit" id="unitOns" value="ons">
                            <label class="form-check-label" for="unitOns">Ons</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="unit" id="unitGram" value="gram">
                            <label class="form-check-label" for="unitGram">Gram</label>
                        </div>
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
                        <div class="col-md-6 mb-2">
                            <label for="stockAmount" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="stockAmount" name="stockAmount" min="1" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="stockUnit" class="form-label">Satuan</label>
                            <select class="form-select" id="stockUnit" name="stockUnit" required>
                                <option value="kg">Kg</option>
                                <option value="ons">Ons</option>
                                <option value="gram">Gram</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stockStatus" id="stockIn" value="in" required>
                                <label class="form-check-label" for="stockIn">Masuk</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stockStatus" id="stockOut" value="out" required>
                                <label class="form-check-label" for="stockOut">Keluar</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="transaksiForm" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-bordered" style="font-size: 12px;">
            <thead style="text-align: center;">
                <tr>
                    <th>Tanggal</th>
                    <th>Orang</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">2023-10-01</td>
                    <td>John Doe</td>
                    <td style="text-align: center;"><span class="badge bg-success">Masuk</span></td>
                    <td style="text-align: center;">50 Kg</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[name="unit"]').change(function() {
            if ($(this).val() === 'kg') {
                $('#show-kg').show();
                $('#show-gram').hide();
                $('#show-ons').hide();
            } else if ($(this).val() === 'gram') {
                $('#show-kg').hide();
                $('#show-gram').show();
                $('#show-ons').hide();
            } else if ($(this).val() === 'ons') {
                $('#show-kg').hide();
                $('#show-gram').hide();
                $('#show-ons').show();
            }
        });

        // Trigger change to set initial visibility
        $('input[name="unit"]:checked').trigger('change');
    });
</script>