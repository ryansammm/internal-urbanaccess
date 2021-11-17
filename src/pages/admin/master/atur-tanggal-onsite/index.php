<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Atur Tanggal On Site</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Kode Minat</td>
                                    <td>Nama</td>
                                    <td>Vendor</td>
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
                                        <td><?= $value['namaPemohon'] ?></td>
                                        <td><?= $value['namaVendor'] ?></td>
                                        <td><?= $value['namaLayanan'] ?>, <?= $value['kecepatan'] ?> Mbps</td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td>
                                            <a class="btn-update btn btn-sm btn-outline-primary" data-id="<?= $value['id'] ?>" href="" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-calendar-alt"></i></a>
                                        </td>
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
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="" class="form-update form-group" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atur Tanggal On Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="first-name-vertical">Jadwal Survey</label>
                                <input type="date" class="form-control" name="tanggalRequest" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 2%;">
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </div>
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

        modal.find('.form-update').prop('action', '/atur-tanggal-onsite/' + id + '/update');
    })

    $(document).ready(function() {
        $('.btn-submit-update').on('click', function() {
            // console.log('.btn-submit-hapus')

            $('.form-update').submit();
        })
    })
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>
</body>

</html>