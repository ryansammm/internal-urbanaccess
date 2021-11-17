<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">

            <form class="form form-vertical" method="post" action="/minat/store" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <h3>Reseller</h3>
                        </div>
                    </div>

                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="row mb-3">
                        <div class="col mb-3">
                            <div class="d-flex justify-content-start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <a href="/reseller/<?= $value['idSales'] ?>/edit" class="btn btn btn-primary float-right"><i class="bi bi-pencil"></i> Edit </a>
                            </div>
                        </div>
                    </div>

                    <!-- Data Reseller -->
                    <h5>Data Reseller</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">NIK Reseller</label>
                                            <h6><?= $datas['nikSales'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Nama Reseller</label>
                                            <h6><?= $datas['namaSales'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Singkatan</label>
                                            <h6><?= $datas['singkatanSales'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Tanggal Bergabung</label>
                                            <h6><?= $datas['tanggalbergabungSales'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Kontak Reseller</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">No. Telp</label>
                                            <h6><?= $data_kontak_telp['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Whatsapp</label>
                                            <h6><?= $data_kontak_whatsapp['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Email</label>
                                            <h6><?= $data_kontak_email['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Rekenening</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Nama Bank</label>
                                            <h6><?= $data_bank['namaBank'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Nomor Rekening</label>
                                            <h6><?= $data_bank_sales['norekeningBanksales'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Lokasi</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Provinsi</label>
                                            <h6><?= $datas['nameProvinsi'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Kabupaten</label>
                                            <h6><?= $datas['nameKabupaten'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Kecamatan</label>
                                            <h6><?= $datas['nameKecamatan'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Kelurahan</label>
                                            <h6><?= $datas['nameKelurahan'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Kode Pos</label>
                                            <h6><?= $datas['kodeposSalesalamat'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Alamat</label>
                                            <h6><?= $datas['alamatSales'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data PIC Internal -->
                    <h5>Data PIC Internal</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">NIK PIC Internal</label>
                                            <h6><?= $datas['nikPic'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Nama PIC Internal</label>
                                            <h6><?= $datas['namaPic'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <h5>Kontak PIC</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">No. Telp</label>
                                            <h6><?= $data_kontak_telp_pic['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Whatsapp</label>
                                            <h6><?= $data_kontak_whatsapp_pic['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Email</label>
                                            <h6><?= $data_kontak_email_pic['isiKontak'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Data Legalitas PIC Internal</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body border border-1 rounded">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Foto NPWP </label>
                                            <h6>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Detail
                                                </button>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">NPWP</label>
                                            <h6><?= $data_legalitas_sales['isiLegalitas'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <a href="/reseller" class="btn btn-secondary me-1">CLose</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto NPWP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="/assets/media/<?= $path_media['pathMedia'] ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/minat.js"></script>


</body>

</html>