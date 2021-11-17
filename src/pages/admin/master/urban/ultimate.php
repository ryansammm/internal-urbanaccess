<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Data User UrbanUltimate</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 10px;"></div>
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
                                        <td><?= $value['statusRegistrasi'] == 2 ? 'Aktif' : 'Pending' ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <a href="/registrasi-user/detail/<?= $value['noRegistrasi'] ?>" class="btn btn-sm btn-light text-primary"><i class="bi bi-eye"></i></a>
                                            </div>
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


    <script src="/assets/js/jquery-3.3.1.min.js"></script>
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