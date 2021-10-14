<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Sales Perorangan</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
                        <a type="button" class="btn btn-sm btn-primary mb-1" href="/sales-perorangan/create">Tambah Data <i class="fas fa-plus"></i></a>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>ID Sales</td>
                                    <td>Nama Sales</td>
                                    <td>TTL</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= $value['idSales'] ?></td>
                                        <td><?= $value['namaSales'] ?></td>
                                        <td><?= $value['tempatLahir'], ", ", $value['tanggalLahir'] ?></td>
                                        <td><?= $value['kelaminSales'] == 1 ? "Perempuan" : "Laki-Laki" ?></td>
                                        <td>Aktif</td>
                                        <td>
                                            <a href="/sales-perorangan/<?= $value['idSales'] ?>/edit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                            <a href="/sales-perorangan/detail/<?= $value['idSales'] ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="btn btn-sm btn-outline-danger btn-hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $value['idSales'] ?>"><i class="fas fa-user-times"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Sales</h5>
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

        modal.find('.form-hapus').prop('action', '/sales-perorangan/' + id + '/delete');
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