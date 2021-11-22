<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">


            <form action="" method="GET">

                <div class="row mb-3 d-flex justify-content-end">
                    <!-- <div class="col-md-4 col-4"></div> -->
                    <div class="col-md-2 col-4 d-flex justify-content-end mt-3">
                        <input class="form-control" type="text" placeholder="Layanan" aria-label="Layanan" name="namaLayanan">
                    </div>
                    <div class="col-md-2 col-4 d-flex justify-content-end mt-3">
                        <input class="form-control" type="text" placeholder="Kota" aria-label="Kota" name="namaKota">
                    </div>
                    <!-- <div class="col-md-2 col-4 d-flex justify-content-end mt-3">
                        <select class="form-select" id="basicSelect" name="statusRegistrasi">
                            <option value="4">Aktif</option>
                            <option value="5">Dimatikan</option>
                        </select>
                    </div> -->
                    <div class="col-md-1 col-2 d-flex justify-content-end mt-3">
                        <button class="btn btn btn-primary" type="submit" id="button-addon2">Search</button>
                    </div>
                </div>

                <!-- <div class="form-control mb-3 me-2">
                    <input type="text" class="form-control" placeholder="Layanan" aria-label="Layanan" aria-describedby="button-addon2">
                    <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div> -->

            </form>

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Data User</h4>



                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
                        <!-- <a type="button" class="btn btn-sm btn-primary mb-1" href="/registrasi-user/create">Tambah Data <i class="fas fa-plus"></i></a> -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Nomor Registrasi</td>
                                        <td>User ID</td>
                                        <td>Nama User</td>
                                        <td>Alamat</td>
                                        <td>Layanan</td>
                                        <td>Biaya Bulanan</td>
                                        <td>Kota</td>
                                        <td>Status</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datas->items as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key += 1 ?></td>
                                            <td><?= $value['noRegistrasi'] ?></td>
                                            <td><?= $value['idUser'] ?></td>
                                            <td><?= $value['namauserRegistrasi'] ?></td>
                                            <td><?= $value['alamat'] ?> RT.<?= $value['rt'] ?>/RW.<?= $value['rw'] ?>, Kel. <?= $value['nameKelurahan'] ?>, Kec. <?= $value['nameKecamatan'] ?>, Kab. <?= $value['nameKabupaten'] ?> <?= $value['kodepos'] ?></td>
                                            <td><?= $value['namaLayanan'] ?>, <?= $value['kecepatan'] ?> Mbps</td>
                                            <td>Rp.<?= $value['biayabulananLayanan'] ?>,-</td>
                                            <td><?= $value['nameKabupaten'] ?></td>
                                            <?php if ($value['tercoverText'] == 'Aktif') { ?>
                                                <td style="color: #00b30e;"><?= $value['tercoverText'] ?></td>
                                            <?php } elseif ($value['tercoverText'] == 'Dimatikan') { ?>
                                                <td style="color: Red;"><?= $value['tercoverText'] ?></td>
                                            <?php  } ?>

                                            <td>

                                                <a class="dropdown-toggle" style="font-size: 11pt;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <!-- <li><a href="#" data-bs-toggle="modal" data-bs-target="#aktivasi" data-id="<?= $value['noRegistrasi'] ?>" class="dropdown-item btn-sm btn-outline-success text-success btn-aktivasi"><i class="fas fa-user-check"></i> Aktivasi</a></li>
                                                <li>
                                                    <hr class="dropdown-divider"> -->
                                                    </li>
                                                    <li><a href="/registrasi-user/detail/<?= $value['noRegistrasi'] ?>" class="dropdown-item text-warning btn-sm btn-outline-warning"><i class="fas fa-eye"></i> Detail</a></li>
                                                    <li> <a href="/registrasi-user/<?= $value['noRegistrasi'] ?>/edit" class="dropdown-item text-primary btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a></li>
                                                    <li> <a href="#" class="dropdown-item btn-sm btn-outline-danger text-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $value['noRegistrasi'] ?>"><i class="fas fa-user-times"></i> Hapus</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li> <a href="#" class="dropdown-item btn-sm btn-outline-success text-success btn-aktif" data-bs-toggle="modal" data-bs-target="#aktifModal" data-id="<?= $value['noRegistrasi'] ?>"><i class="fas fa-check"></i> Aktifkan</a></li>
                                                    <li> <a href="#" class="dropdown-item btn-sm btn-outline-danger text-danger btn-mati" data-bs-toggle="modal" data-bs-target="#matiModal" data-id="<?= $value['noRegistrasi'] ?>"><i class="fas fa-power-off"></i> Matikan</a></li>
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
                        <?= $datas->links() ?>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<!------- Delete Modal ------->
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


<!------- Aktif Modal ------->
<div class="modal fade" id="aktifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Aktivasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Aktfikna User Ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-submit-aktif">Aktifkan</button>
                <form action="" method="POST" class="form-aktif"></form>
            </div>
        </div>
    </div>
</div>

<!------- Dimatikan Modal ------->
<div class="modal fade" id="matiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Aktivasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Matikan User Ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-submit-mati">Matikan</button>
                <form action="" method="POST" class="form-mati"></form>
            </div>
        </div>
    </div>
</div>

<!------- Status Modal ------->
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
    /* ------------------------------- Modal Hapus ------------------------------ */
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


    /* ------------------------------- Modal Aktif ------------------------------ */
    $(document).on('click', '.btn-aktif', function() {
        var modal = $('#aktifModal');
        var id = $(this).attr('data-id');

        modal.find('.form-aktif').prop('action', '/registrasi-user/' + id + '/aktif');
    })

    $(document).ready(function() {
        $('.btn-submit-aktif').on('click', function() {
            $('.form-aktif').submit();
        })
    })


    /* ------------------------------- Modal Matikan ------------------------------ */
    $(document).on('click', '.btn-mati', function() {
        var modal = $('#matiModal');
        var id = $(this).attr('data-id');
        console.log(8778);
        modal.find('.form-mati').prop('action', '/registrasi-user/' + id + '/mati');
    })

    $(document).ready(function() {
        $('.btn-submit-mati').on('click', function() {
            $('.form-mati').submit();
        })
    })


    /* ------------------------------ Modal Status ------------------------------ */
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
<script src="/assets/vendors/choices.js/choices.min.js"></script>
</body>

</html>