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
                        <table class="table" id="table1">
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
                                <?php foreach ($data_minat as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= $value['kodeMinat'] ?></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td>
                                            <a href="/registrasi-user-minat/<?= $value['kodeMinat'] ?>/create" class="btn-sm btn btn-outline-primary "><i class="fas fa-user-plus"></i></i></a>
                                            <a href="#" class=" btn-sm btn btn-outline-danger btn-cancel" data-bs-toggle="modal" data-bs-target="#cancelModal" data-id="<?= $value['kodeMinat'] ?>"><i class="fas fa-times"></i></a>
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
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" class="form-cancel">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Masukan Alasan" name="keterangan" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Catatan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-submit-cancel">Simpan</button>
                    </div>
                </form>
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

    $(document).on('click', '.btn-cancel', function() {
        var modal = $('#cancelModal');
        var id = $(this).attr('data-id');

        modal.find('.form-cancel').prop('action', '/minat/' + id + '/cancel');
    })

    $(document).ready(function() {
        $('.btn-submit-cancel').on('click', function() {
            $('.form-cancel').submit();
        })
    })
</script>

<script src="/assets/js/main.js"></script>
</body>

</html>