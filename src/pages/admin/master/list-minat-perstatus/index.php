<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">



        <section class="section">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Daftar <?= $judul ?></h4>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
                </div>
                <div class="row">
                    <div class="col-3 text-center ps-4">
                        <a href="/minat-status/1">
                            <div class="card form-group3 <?= $status == 1 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Minat</label>
                                    <h6><?= $count1 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/minat-status/2">
                            <div class="card form-group3 <?= $status == 2 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Menunggu Hasil Survey (Soft)</label>
                                    <h6><?= $count2 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/minat-status/3">
                            <div class="card form-group3 <?= $status == 3 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Konfirmasi Peminat (Soft)</label>
                                    <h6><?= $count3 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center pe-4">
                        <a href="/minat-status/4">
                            <div class="card form-group3 <?= $status == 4 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Lanjut Onsite</label>
                                    <h6><?= $count4 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-center ps-4">
                        <a href="/minat-status/5">
                            <div class="card form-group3 <?= $status == 5 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Menunggu Hasil Survey (Onsite)</label>
                                    <h6><?= $count5 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/minat-status/6">
                            <div class="card form-group3 <?= $status == 6 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Konfirmasi Peminat (Onsite)</label>
                                    <h6><?= $count6 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/minat-status/7">
                            <div class="card form-group3 <?= $status == 7 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">Hasil</label>
                                    <h6><?= $count7 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3 text-center pe-4">
                        <a href="/minat-status/8">
                            <div class="card form-group3 <?= $status == 8 ? 'form-group-active' : '' ?>">
                                <div class="">
                                    <label for="first-name-vertical">FAB</label>
                                    <h6><?= $count8 ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </section>


        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Kode Minat</td>
                                    <td>Tanggal</td>
                                    <td>Nama</td>
                                    <td>Layanan</td>
                                    <td>Alamat</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><a href="/minat/<?= $value['kodeMinat'] ?>"><?= $value['kodeMinat'] ?></a></td>
                                        <td><?= date('d-m-Y', strtotime($value['createdAt'])) ?></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin?
            </div>
            <div class="modal-footer">
                <a href="" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <a href="/minat/<?= $value['kodeMinat'] ?>/delete" type="button" class="btn btn-danger" data-bs-dismiss="modal">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>

<script src="/assets/js/main.js"></script>
</body>

</html>