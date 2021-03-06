<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Request Survey</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table " id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Kode Minat</td>
                                    <td>Nama</td>
                                    <td>Layanan</td>
                                    <td>Alamat</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><a href="/minat/<?= $value['kodeMinat'] ?>"><?= $value['kodeMinat'] ?></a></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><a href="" class="btn-update btn btn-sm btn-outline-primary" data-id="<?= $value['kodeMinat'] ?>" data-nama="<?= $value['namapemohon'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-envelope"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email ke Vendor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ro">
                    <div class="col">
                        <div class="form-group">
                            <label for="first-name-vertical">Nama</label>
                            <input type="text" class="form-control namaPemohon" name="namapemohon" value="" required readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="first-name-vertical">Pilih Vendor</label>
                            <select class="choices form-select multiple-remove select-vendor" multiple="multiple" required>
                                <optgroup label="Vendor">
                                    <?php foreach ($data_vendor as $key => $value) { ?>
                                        <option value="<?= $value['idVendor'] ?>"><?= $value['namaVendor'] ?></option>
                                    <?php } ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-submit-update">Kirim Email Ke Vendor</button>
            </div>
        </div>
        <form action="" method="POST" class="form-update">
            <input type="hidden" name="idVendor" class="btn-list-vendor">
        </form>
    </div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);

    $(document).on('click', '.btn-update', function() {
        var modal = $('#updateModal');
        var id = $(this).attr('data-id');

        modal.find('.form-update').prop('action', '/request-survey-vendor/' + id + '/update');
    })

    $(document).ready(function() {
        $('.btn-submit-update').on('click', function() {
            var select = $('.select-vendor').val()
            // console.log(select)
            if (select.length == 0) {
                alert("Vendor Belum Dipilih")
            } else {
                $('.form-update').submit();
            }
        })
    })

    $(document).on('change', '.select-vendor', function() {
        var vendor = $(this).val()
        $('.btn-list-vendor').val(vendor)
    })


    $(document).on('click', '.btn-update', function() {
        var modal = $('#updateModal');
        var nama = $(this).attr('data-nama');
        modal.find('.namaPemohon').val(nama)
        // console.log(nama)
    })
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>
</body>

</html>