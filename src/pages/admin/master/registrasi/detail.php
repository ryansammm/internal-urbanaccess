<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-start">
                            <h3>Nomor Registrasi - <?= $datas['noRegistrasi'] ?></h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <!-- <a href="/vendor/<?= $datas['idVendor'] ?>/edit" class="btn btn-sm btn-primary float-right"><i class="bi bi-pencil"></i> Edit </a> -->
                        </div>
                    </div>
                </div>

                <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                <div class="form-body">

                    <h5>Data Pelanggan</h5>
                    <div class="p-2">

                        <!-- <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Nomor Registrasi</label>
                                    <h6><?= $datas['noRegistrasi'] ?></h6>
                                </div>
                            </div>
                        </div> -->

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kode Form</label>
                                    <h6><?= $datas['kodeformInternetregistrasi'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Jenis User</label>
                                    <h6>
                                        <?php if ($datas['jenisuserRegistrasi'] == 1) {
                                            echo "Perorangan";
                                        } elseif ($datas['jenisuserRegistrasi'] == 2) {
                                            echo "Instansi Swasta / Korporasi";
                                        } elseif ($datas['jenisuserRegistrasi'] == 3) {
                                            echo "Kedinasan";
                                        } else {
                                            echo "Mitra";
                                        }
                                        ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Tanggal Registrasi</label>
                                    <h6><?= $datas['tanggalRegistrasi'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">User ID</label>
                                    <h6><?= $datas['idUser'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Nama Penanggung Jawab</label>
                                    <h6><?= $datas['namauserRegistrasi'] ?></h6>
                                </div>
                            </div>
                        </div>

                        <!-- Data Kontak Vendor -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">No. Telp</label>
                                    <h6><?= $data_kontak_telp['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Whatsapp</label>
                                    <h6><?= $data_kontak_whatsapp['isiKontak'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Email</label>
                                    <h6><?= $data_kontak_email['isiKontak'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Data Layanan</h5>
                    <div class="p-2">
                        <!-- Data Kontak Vendor -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Layanan</label>
                                    <h6><?= $data_internet_user_layanan['namaLayanan'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Kecepatan</label>
                                    <h6><?= $data_internet_user_layanan['kecepatan'] ?> Mbps</h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Sales</label>
                                    <h6><?= $datas[40] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Alamat Pemasangan</h5>
                    <div class="p-2">

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
                                    <h6><?= $datas['kodepos'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">RT/RW</label>
                                    <h6><?= $datas['rt'] ?>/<?= $datas['rw'] ?></h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Koordinat</label>
                                    <h6><?= $datas['latitude'] ?>,<?= $datas['longtitude'] ?></h6>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Alamat *</label>
                                    <h6><?= $datas['alamat'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>




                    <h5>Data PIC Internal</h5>
                    <div class="p-2">

                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">NIK PIC</label>
                                    <h6><?= $datas['nikPic'] ?></h6>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Nama PIC Internal </label>
                                    <h6><?= $datas['namaPic'] ?></h6>
                                </div>
                            </div>
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
                    </div>




                    <h5>Persyaratan</h5>
                    <div class="p-2">

                        <!-- Data Kontak Vendor -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <h6>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#npwmpMODAL">
                                            Detail
                                        </button>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">NPWP </label>
                                    <h6><?= $data_legalitas_vendor['isiLegalitas'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <h5>Data Vendor</h5>
                    <div class="p-2">

                        <!-- Data Kontak Vendor -->
                        <div class="row border border-1 rounded mb-3 p-2">
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Nama Vendor</label>
                                    <h6><?= $data_internet_user_vendor['namaVendor'] ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Jenis</label>
                                    <h6><?= $data_internet_user_vendor['jenislinkVendor'] == 1 ? "Link Utama" : "Link Backup" ?></h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Media Koneksi</label>
                                    <h6><?= $data_internet_user_vendor['mediakoneksiVendor'] == 1 ? "Fiber Optic" : "Wireless" ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Biaya Registrasi</label>
                                    <h6><?= "Rp " . number_format($data_internet_user_layanan['biayaregistrasiLayanan'], 2, ',', '.'); ?></h6>

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">Biaya Bulanan</label>
                                    <h6><?= "Rp " . number_format($data_internet_user_layanan['biayabulananLayanan'], 2, ',', '.'); ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">PPN Biaya Instalasi</label>
                                    <h6><?= $data_internet_user_vendor['ppnbiayainstalasi'] == 1 ? "Ya" : "Tidak"  ?></h6>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group2">
                                    <label for="first-name-vertical">PPN Biaya Bulanan</label>
                                    <h6><?= $data_internet_user_vendor['ppnbiayabulanan'] == 1 ? "Ya" : "Tidak"  ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/registrasi-user" type="button" class="btn btn-secondary float-end">Close</a>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<!-- Modal NPWP-->
<div class="modal fade" id="npwmpMODAL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto NPWP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="/assets/media/<?= $npwp['pathMedia'] ?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>


<!-- Modal 1 -->
<!-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="first-name-vertical">PPN Biaya Instalasi</label>
                        <select name="ppnbiayainstalasi" id="" class="form-select">
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">PPN Biaya Bulanan</label>
                        <select name="ppnbiayabulanan" id="" class="form-select">
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Apply</button>
            </div>
        </div>
    </div>
</div> -->


<!-- Modal 2 -->
<!-- <div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Harga Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="first-name-vertical">Biaya Instalasi</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">RP.</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">PPN </label>
                        <div class="input-group mb-3">
                            <select name="" id="" class="form-select">
                                <option value="">Ya</option>
                                <option value="">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">Total Biaya Instalasi</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">RP.</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="first-name-vertical">Biaya Bulanan</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">RP.</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">PPN </label>
                        <div class="input-group mb-3">
                            <select name="" id="" class="form-select">
                                <option value="">Ya</option>
                                <option value="">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">Total Biaya Bulanan</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">RP.</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script src=" /assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/registrasi-user.js"></script>


</body>

</html>