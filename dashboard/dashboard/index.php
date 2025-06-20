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
    <div class="col-12 mt-4">
        <table class="table table-bordered">
            <thead style="text-align: center;">
                <tr>
                    <th>Tanggal</th>
                    <th>Orang</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2023-10-01</td>
                    <td>John Doe</td>
                    <td><span class="badge bg-success">Masuk</span></td>
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