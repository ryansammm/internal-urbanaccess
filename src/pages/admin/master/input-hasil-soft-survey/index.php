<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
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
                        <h4 class="card-title mb-3">Daftar Hasil Survey</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table " id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Tanggal Request</td>
                                    <td>Kode Minat</td>
                                    <td>Nama</td>
                                    <td>Layanan</td>
                                    <td>Alamat</td>
                                    <td>Koordinat</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($minat_input_hasil_survey as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><?= date("l, d-m-Y H:i:s", strtotime($value['tanggalRequest'])) ?></td>
                                        <td><a href="/minat/<?= $value['kodeMinat'] ?>"><?= $value['kodeMinat'] ?></a></td>
                                        <td><?= $value['namapemohon'] ?></td>
                                        <td><?= $value['namaLayanan'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><?= $value['latitude'] ?>,<?= $value['longtitude'] ?></td>
                                        <td>
                                            <a class="vendor btn btn-sm btn-outline-primary " data-id="<?= $value['kodeMinat'] ?>" href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-plus"></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" class="formweh form-group2" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Hasil Soft Survey</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row anyar">
                        <div class="col-md-6">
                            <div class="card-body form-group border border-1 rounded">
                                <h5>Vendor</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="first-name-vertical">Tanggal Keluar Hasil Survey</label>
                                        <input type="date" class="form-control" name="tanggalHasil" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="first-name-vertical">Status</label>
                                        <select name="hasil" id="" class="form-select">
                                            <option value="1">Tercover</option>
                                            <option value="2">Tidak Tercover</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="first-name-vertical">Jarak</label>
                                        <div class="input-group ">
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="jarak" required>
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="first-name-vertical">Biaya Instalasi</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control number" name="biayaInstalasi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="first-name-vertical">Keterangan</label>
                                        <textarea name="keterangan" id="" class=" form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
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

        modal.find('.form-hapus').prop('action', '/layanan-internet/' + id + '/delete');
    })

    $(document).ready(function() {
        $('.btn-submit-hapus').on('click', function() {
            $('.form-hapus').submit();
        })
    })

    $('input.number').keyup(function(event) {

        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>
<script src="/assets/js/input-hasil-soft-survey.js"></script>
</body>

</html>