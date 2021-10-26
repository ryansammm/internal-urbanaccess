<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Menunggu Instalasi</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table " id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nomor Registrasi</td>
                                    <td>User ID</td>
                                    <td>Nama User</td>
                                    <td>Layanan</td>
                                    <td>Sales</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_internet_user_registrasi as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= $value['noRegistrasi'] ?></td>
                                        <td><?= $value['idUser'] ?></td>
                                        <td><?= $value['namauserRegistrasi'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['namaSales'] ?></td>
                                        <td><?= $value['statusRegistrasi'] == 2 ? 'Sudah Aktivasi' : 'Registrasi' ?></td>
                                        <td><a href="" class="btn-update btn btn-sm btn-outline-primary" data-id="<?= $value['noRegistrasi'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-tools"></i></a></td>
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
        <form action="" class="form-update form-group" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hasil Instalasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ro">
                        <div class="col">
                            <div class="form-group">
                                <label for="first-name-vertical">Tanggal Instalasi</label>
                                <input type="date" class="form-control" name="tglInstalasi" value="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="first-name-vertical">Jarak</label>
                                <input type="text" class="form-control" name="jarak" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-submit-update">Konfirmasi</button>
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

        modal.find('.form-update').prop('action', '/instalasi/' + id + '/store');
    })

    $(document).ready(function() {
        $('.btn-submit-update').on('click', function() {
            $('.form-update').submit();
        })
    })

    $(document).on('change', '.select-vendor', function() {
        var vendor = $(this).val()
        $('.btn-list-vendor').val(vendor)
    })
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>

<!-- DropzoneJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>