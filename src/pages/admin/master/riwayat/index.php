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
                        <h4 class="card-title mb-3">Riwayat</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Deskripsi</td>
                                    <td>Tanggal</td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($data_minat as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= $value['kodeMinat'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($value['createdAt'])) ?></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><?= $value['statusText'] ?></td>
                                        <td>
                                            <a href="/minat/<?= $value['kodeMinat'] ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?> -->
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