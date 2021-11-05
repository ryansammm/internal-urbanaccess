<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-start">
                            <h3><?= $datas['namaVendor'] ?></h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="/vendor/<?= $datas['idVendor'] ?>/edit" class="btn btn-sm btn-primary float-right"><i class="fas fa-edit"></i> Edit </a>
                        </div>
                    </div>
                </div>

                <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>
                <div class="form-body">

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="p-3 border border-1 rounded">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group2">
                                            <label for="first-name-vertical">Kode</label>
                                            <h6><?= $datas['kodeVendor'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Vendor -->
                    <h5>Data Vendor</h5>
                    <div class="p-2">

                        <!-- Data Kontak Vendor -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">No. Telp</label>
                                    <h6><?= $data_kontak_telp_vendor['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Whatsapp</label>
                                    <h6><?= $data_kontak_whatsapp_vendor['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Email</label>
                                    <h6><?= $data_kontak_email_vendor['isiKontak'] ?></h6>
                                </div>
                            </div>
                        </div>


                        <!-- Alamat Saat Ini -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Provinsi</label>
                                    <h6><?= $datas['nameProvinsi'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kabupaten</label>
                                    <h6><?= $datas['nameKabupaten'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kecamatan</label>
                                    <h6><?= $datas['nameKecamatan'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kelurahan</label>
                                    <h6><?= $datas['nameKelurahan'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kode Pos</label>
                                    <h6><?= $datas['kodeposVendor'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Alamat</label>
                                    <h6><?= $datas['alamatVendor'] ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">NPWP</label>
                                    <h6><?= $data_legalitas_vendor['isiLegalitas'] ?></h6>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group2">
                                    <h6>
                                        <button style="margin-top: 7pt;" type="button" class="btn btn-sm btn-primary btn-media-vendor" data-bs-med-vendor="/assets/media/<?= $path_media_vendor['pathMedia'] ?> " data-bs-toggle="modal" data-bs-target="#vendorModal">
                                            Detail
                                        </button>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Data PIC Internal -->
                    <h5 class="mt-3">Data PIC Internal</h5>
                    <div class="p-2">

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">NIK PIC Internal *</label>
                                    <h6><?= $datas['nikPic'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Nama PIC Internal *</label>
                                    <h6><?= $datas['namaPic'] ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">No. Telp </label>
                                    <h6><?= $data_kontak_telp_pic['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Whatsapp </label>
                                    <h6><?= $data_kontak_whatsapp_pic['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Email </label>
                                    <h6><?= $data_kontak_email_pic['isiKontak'] ?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">NPWP </label>
                                    <h6><?= $data_legalitas_pic['isiLegalitas'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <h6>
                                        <button style="margin-top: 7pt;" type="button" class="btn btn-sm btn-primary btn-media-pic" data-bs-med-pic="/assets/media/<?= $path_media_pic['pathMedia'] ?>" data-bs-toggle="modal" data-bs-target="#picModal">
                                            Detail
                                        </button>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3 card-footer">
                <a class="btn btn-secondary me-1 mb-1" href="/vendor">
                    Close
                </a>
            </div>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<!-- Modal Foto Lokasi Vendor -->
<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorModalLabel">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="/assets/media/<?= $path_media_vendor['pathMedia'] ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Modal Foto Lokasi PIC -->
<div class="modal fade" id="picModal" tabindex="-1" aria-labelledby="picModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="picModalLabel">Foto Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="/assets/media/<?= $path_media_pic['pathMedia'] ?>" class="img-fluid" alt="">
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
<script src="/assets/js/vendor.js"></script>


</body>

</html>