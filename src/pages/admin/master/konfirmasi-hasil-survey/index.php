<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="page-heading">

        <section class="section">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daftar Konfirmasi Survey</h4>
                        <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Kode Minat</td>
                                    <td>Nama</td>
                                    <td>Vendor</td>
                                    <td>Jarak</td>
                                    <td>Layanan</td>
                                    <td>Alamat</td>
                                    <td>Status</td>

                                    <?php if ($_SESSION['idRole'] != 'mitra-010') { ?>
                                        <td>Aksi</td>
                                    <?php } ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datas as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key += 1 ?></td>
                                        <td><a href="/minat/<?= $value['kodeMinat'] ?>"><?= $value['kodeMinat'] ?></a></td>
                                        <td><?= $value['namaPemohon'] ?></td>
                                        <td><?= $value['namaVendor'] ?></td>
                                        <td><?= $value['jarak'] ?></td>
                                        <td><?= $value['namaLayanan'] ?>, <?= $value['kecepatan'] ?> Mbps</td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><?= $value['hasil'] == 1 ? "Tercover" : "Tidak Tercover" ?></td>

                                        <?php if ($_SESSION['idRole'] != 'mitra-010') { ?>
                                            <td>
                                                <a class="detail btn btn-sm btn-outline-primary" href="" data-id="<?= $value['id'] ?>" data-idVendor="<?= $value['idVendor'] ?>" data-bs-toggle="modal" data-bs-target="#detailModal"><i class="far fa-calendar-check"></i></a>
                                            </td>
                                        <?php } ?>


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
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lanjut Survey On Site</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" class="form-detail">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h5>Vendor : <span class="namaVendor"></span></h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td style="width: 35%;">Panjang Kabel</td>
                                    <td>:</td>
                                    <td class="jarak"></td>
                                </tr>
                                <tr>
                                    <td>Biaya Instalasi</td>
                                    <td>:</td>
                                    <td class="biayaInstalasi"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Survey</td>
                                    <td>:</td>
                                    <td class="tglSurvey">2021-09-07</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Hasil Survey</td>
                                    <td>:</td>
                                    <td class="tglHasilSurvey">2021-09-07</td>
                                </tr>
                            </table>
                            <p>Apakah anda yakin ingin melanjut data peminat ini ke survey on site?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
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

    $(document).on('click', '.detail', function() {
        var modal = $('#detailModal');
        var id = $(this).attr('data-id');
        var idVendor = $(this).attr('data-id');

        modal.find('.form-detail').prop('action', '/konfirmasi-hasil-survey/' + id + '/update');


        $.ajax({
            url: "/request-survey-vendor/get/" + id,
            method: "get",
        }).done(function(data) {
            modal.find('.namaVendor').html(data.namaVendor);
            modal.find('.jarak').html(data.jarak + ' Meter');
            modal.find('.biayaInstalasi').html('Rp.' + data.biayaInstalasi + ',-');
            modal.find('.tglSurvey').html(data.tanggalRequest);
            modal.find('.tglHasilSurvey').html(data.tanggalHasil);
        });

    })


    $(document).ready(function() {
        $('.btn-submit-hapus').on('click', function() {
            $('.form-hapus').submit();
        })
    })
</script>

<script src="/assets/js/main.js"></script>
<script src="/assets/js/choices.min.js"></script>
</body>

</html>