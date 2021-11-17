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
                                    <td>Alamat</td>
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
                                        <td><?= $value['nomorRegistrasi'] ?></td>
                                        <td><?= $value['alamat'] ?> RT.<?= $value['rt'] ?>/RW.<?= $value['rw'] ?>, Kel. <?= $value['nameKelurahan'] ?>, Kec. <?= $value['nameKecamatan'] ?>, Kab. <?= $value['nameKabupaten'] ?> <?= $value['kodepos'] ?></td>
                                        <td><?= $value['namauserRegistrasi'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['namaSales'] ?></td>
                                        <td><?= $value['statusRegistrasi'] == 2 ? 'Sudah Aktivasi' : 'Menunggu Penjadwalan' ?></td>
                                        <td>


                                            <a href="" class="btn-update btn btn-sm btn-outline-primary <?= $value['jarak'] != NULL ? "disabled" : "" ?>" data-id="<?= $value['nomorRegistrasi'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fas fa-plus"></i></a>
                                            <a href="" class="btn-edit btn btn-sm btn-outline-warning" data-id="<?= $value['nomorRegistrasi'] ?>" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></a>
                                            <a href="/instalasi/dokumentasi/<?= $value['nomorRegistrasi'] ?>" class="btn-dokumentasi btn btn-sm btn-outline-secondary"><i class="fas fa-camera"></i></a>
                                            <a href="" class="btn-detail btn btn-sm btn-outline-success" data-id="<?= $value['nomorRegistrasi'] ?>" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="fas fa-check"></i></a>
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


<!---------------------------- Tambah Data Instalasi --------------------------->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" class="form-update form-group" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hasil Instalasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
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


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" class="form-edit form-group" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Instalasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="first-name-vertical">Tanggal Instalasi</label>
                                <input type="date" class="form-control tanggalEdit" name="tglInstalasi" value="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="first-name-vertical">Jarak</label>
                                <input type="text" class="form-control jarakEdit" name="jarak" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-submit-edit">Konfirmasi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Instalasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-6">
                    <form action="" class="form-detail">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="width: 35%;">Tanggal Instalasi</td>
                                            <td>:</td>
                                            <td class="tglInstalasi"></td>
                                        </tr>
                                        <tr>
                                            <td>Jarak</td>
                                            <td>:</td>
                                            <td class="jarak"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-right" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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


    // Store Data Instalasi
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

<script>
    // Update Data Instalasi 
    $(document).on('click', '.btn-edit', function() {
        var modal = $('#editModal');
        var id = $(this).attr('data-id');

        modal.find('.form-edit').prop('action', '/instalasi/' + id + '/update');

        $.ajax({
            url: "/instalasi/get/" + id,
            method: "get",
        }).done(function(data) {
            modal.find('.tanggalEdit').val(data.tglInstalasi);
            modal.find('.jarakEdit').val(data.jarak);
        });

    })

    $(document).ready(function() {
        $('.btn-submit-edit').on('click', function() {
            $('.form-edit').submit();
        })
    })

    $(document).on('change', '.select-vendor', function() {
        var vendor = $(this).val()
        $('.btn-list-vendor').val(vendor)
    })
</script>

<script>
    // Konfirmasi Data Instalasi
    $(document).on('click', '.btn-detail', function() {
        var modal = $('#detailModal');
        var id = $(this).attr('data-id');
        // console.log(modal)

        modal.find('.form-detail').prop('action', '/instalasi/' + id + '/status');


        $.ajax({
            url: "/instalasi/get/" + id,
            method: "get",
        }).done(function(data) {
            modal.find('.tglInstalasi').html(data.tglInstalasiInd);
            modal.find('.jarak').html(data.jarak + ' Meter');
        });

    })
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>

<!-- DropzoneJS -->
<script src="/plugins/dropzone/dropzone.js"></script>

</body>

</html>