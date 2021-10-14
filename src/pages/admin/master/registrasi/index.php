<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Data User</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
                        <a type="button" class="btn btn-sm btn-primary mb-1" href="/registrasi-user/create">Tambah Data <i class="fas fa-plus"></i></a>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nomor Registrasi</td>
                                    <td>Kode Form</td>
                                    <td>User ID</td>
                                    <td>Nama User</td>
                                    <td>Layanan</td>
                                    <td>Sales</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= $value['noRegistrasi'] ?></td>
                                        <td><?= $value['kodeformInternetregistrasi'] ?></td>
                                        <td><?= $value['idUser'] ?></td>
                                        <td><?= $value['namauserRegistrasi'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['namaSales'] ?></td>
                                        <td><?= $value['statusRegistrasi'] == 2 ? 'Sudah Aktivasi' : 'Belum Aktivasi' ?></td>
                                        <td>

                                            <a class=dropdown-toggle" style="font-size: 11pt;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#aktivasi" data-id="<?= $value['noRegistrasi'] ?>" class="dropdown-item btn-sm btn-outline-success text-success btn-aktivasi"><i class="fas fa-user-check"></i> Aktivasi</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a href="/registrasi-user/detail/<?= $value['noRegistrasi'] ?>" class="dropdown-item text-warning btn-sm btn-outline-warning"><i class="fas fa-eye"></i> Detail</a></li>
                                                <li> <a href="/registrasi-user/<?= $value['noRegistrasi'] ?>/edit" class="dropdown-item text-primary btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a></li>
                                                <li> <a href="#" class="dropdown-item btn-sm btn-outline-danger text-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $value['noRegistrasi'] ?>"><i class="fas fa-user-times"></i> Hapus</a></li>
                                            </ul>

                                            <!-- <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <a href="/registrasi-user/detail/<?= $value['noRegistrasi'] ?>" class=" btn-sm btn-outline-warning"><i class="fas fa-eye"></i></a>
                                                <a href="/registrasi-user/<?= $value['noRegistrasi'] ?>/edit" class=" btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                                <a href="#" class=" btn-sm btn-outline-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $value['noRegistrasi'] ?>"><i class="fas fa-user-times"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#aktivasi" data-id="<?= $value['noRegistrasi'] ?>" class="btn-sm btn-outline-success btn-aktivasi"><i class="fas fa-user-check"></i></a>
                                            </div> -->
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin untuk menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-submit-hapus">Hapus</button>
                <form action="" method="POST" class="form-hapus"></form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="aktivasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Aktivasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Ubah status menjadi aktif ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary  btn-submit-aktivasi">Ya</button>
                <form action="" method="POST" class="form-aktivasi"></form>
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

    $(document).on('click', '.btn-hapus', function() {
        var modal = $('#deleteModal');
        var id = $(this).attr('data-id');

        modal.find('.form-hapus').prop('action', '/registrasi-user/' + id + '/delete');
    })

    $(document).ready(function() {
        $('.btn-submit-hapus').on('click', function() {
            $('.form-hapus').submit();
        })
    })

    $(document).on('click', '.btn-aktivasi', function() {
        var modal = $('#aktivasi');
        var id = $(this).attr('data-id');

        modal.find('.form-aktivasi').prop('action', '/registrasi-user/' + id + '/status');
    })

    $(document).ready(function() {
        $('.btn-submit-aktivasi').on('click', function() {
            $('.form-aktivasi').submit();
        })
    })
</script>

<script src="/assets/js/main.js"></script>
</body>

</html>