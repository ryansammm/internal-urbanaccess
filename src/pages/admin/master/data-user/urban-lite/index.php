<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <header>
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <!-- <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Registrasi</h3>
                            <p class="text-subtitle text-muted">bank</p>
                        </div> -->
                <!-- <div class="col-12 col-md-12 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Bank</li>
                                </ol>
                            </nav>
                        </div> -->
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Data User</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <a type="button" class="btn btn-sm btn-warning mt-3" href="/data-user/create">Tambah Data <i class="fas fa-plus"></i></a>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Nomor Registrasi</td>
                                    <td>Kode Form</td>
                                    <td>User ID</td>
                                    <td>nama User</td>
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
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td>Rp. <?= number_format($value['biayadasarregistrasiLayanan'], 2, ',', '.',) ?></td>
                                        <td>Rp. <?= number_format($value['biayaregistrasi'], 2, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($value['biayaregistrasi'], 2, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($value['biayaregistrasi'], 2, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($value['biayaregistrasi'], 2, ',', '.') ?></td>
                                        <td><?= $value['ppn'] == '1' ? 'Ya' : 'Tidak' ?></td>
                                        <td>
                                            <a href="/layanan-internet/<?= $value['idLayananinternet'] ?>/edit" class="btn btn-sm btn-light text-primary"><i class="bi bi-pencil"></i></a>
                                            <a href="#" class="btn btn-sm btn-light text-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $value['idLayananinternet'] ?>"><i class="bi bi-trash"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Layanan Internet</h5>
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

    <?php include('../src/pages/adminhelper/footer.php'); ?>
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

        modal.find('.form-hapus').prop('action', '/layanan-internet/' + id + '/delete');
    })

    $(document).ready(function() {
        $('.btn-submit-hapus').on('click', function() {
            $('.form-hapus').submit();
        })
    })
</script>

<script src="/assets/js/main.js"></script>
</body>

</html>