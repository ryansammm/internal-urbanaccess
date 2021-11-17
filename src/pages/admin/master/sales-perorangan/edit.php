<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/sales-perorangan/<?= $detail['idSales'] ?>/update" enctype="multipart/form-data">

                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/sales-perorangan" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Form Edit Sales Perorangan</h4>
                            <p style="font-size: 13px;">Data Sales Perorangan</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="form-body">

                        <!-- Data Pemohon -->
                        <h5>Data Sales</h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">NIK Reseller *</label>
                                    <input type="text" class="form-control" name="nikSales" value="<?= $detail['nikSales'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Sales *</label>
                                    <input type="text" class="form-control" name="namaSales" value="<?= $detail['namaSales'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Bergabung *</label>
                                    <input type="date" class="form-control" name="tanggalbergabungSales" value="<?= $detail['tanggalbergabungSales'] ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Data Diri-->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Jenis Kelamin *</label>
                                    <select class="form-control" name="kelaminSales">
                                        <option value="2">Laki-Laki</option>
                                        <option value="1">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Tempat Lahir *</label>
                                    <input type="text" class="form-control" name="tempatLahir" value="<?= $detail['tempatLahir'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Lahir *</label>
                                    <input type="date" class="form-control" name="tanggalLahir" value="<?= $detail['tanggalLahir'] ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Rekening -->
                        <h5>Rekenening</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td><label for="first-name-vertical">Nama Bank *</label></td>
                                                <td><label for="first-name-vertical">Nomor Rekening *</label></td>
                                            </tr>
                                        </thead>
                                        <tbody class="bankContainer">
                                            <tr>
                                                <td style="width: 22%;">
                                                    <select name="idBank" id="" class="form-select">
                                                        <option value="">Pilih Bank</option>
                                                        <?php foreach ($data_bank as $key => $value) { ?>
                                                            <option <?= $value['idBank'] == $value['namaBank'] ? 'selected' : '' ?> value="<?= $value['idBank'] ?>"><?= $value['namaBank'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td style="width: 70%;">
                                                    <div class="input-group">
                                                        <input type="text" name="norekeningBanksales" id="" class="form-control" value="<?= $data_bank_sales['norekeningBanksales'] ?>">
                                                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                                                        <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Data Kontak Reseller -->
                        <h5>Data Kontak Sales</h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">No. Telp *</label>
                                    <input type="text" class="form-control" name="telpkontak" value="<?= $data_kontak_telp['isiKontak'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Whatsapp *</label>
                                    <input type="text" class="form-control" name="whatsappkontak" value="<?= $data_kontak_whatsapp['isiKontak'] ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Email *</label>
                                    <input type="text" class="form-control" name="emailkontak" value="<?= $data_kontak_email['isiKontak'] ?>">
                                </div>
                            </div>
                        </div>



                        <!-- Alamat Saat Ini -->
                        <h5>Alamat Saat Ini</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Provinsi *</label>
                                    <select name="idProvinsiSaatIni" id="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($data_provinsi as $key => $value) { ?>
                                            <option <?= $value['id'] == $data_sales_alamat_saat_ini['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kabupaten *</label>
                                    <select name="idKabupatenSaatIni" id="kabupaten" class="form-control" disabled>
                                        <option value=""> -- Pilih Kabupaten -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kecamatan *</label>
                                    <select name="idKecamatanSaatIni" id="kecamatan" class="form-control" disabled>
                                        <option value=""> -- Pilih Kecamatan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kelurahan *</label>
                                    <select name="idKelurahanSaatIni" id="kelurahan" class="form-control" disabled>
                                        <option value=""> -- Pilih Kelurahan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kode Pos *</label>
                                    <input type="text" class="form-control" name="kodeposSalesalamatSaatIni" value="<?= $data_sales_alamat_saat_ini['kodeposSalesalamat'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Alamat *</label>
                                    <textarea name="alamatSalesSaatIni" id="" class="form-control"><?= $data_sales_alamat_saat_ini['alamatSales'] ?></textarea>
                                </div>
                            </div>
                        </div>


                        <!-- Alamat Identitas -->
                        <h5>Alamat Identitas</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Provinsi *</label>
                                    <select name="idProvinsiIdentitas" id="provinsiIdentitas" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($data_provinsi as $key => $value) { ?>
                                            <option <?= $value['id'] == $data_sales_alamat_identitas['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kabupaten *</label>
                                    <select name="idKabupatenIdentitas" id="kabupatenIdentitas" class="form-control" disabled>
                                        <option value=""> -- Pilih Kabupaten -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kecamatan *</label>
                                    <select name="idKecamatanIdentitas" id="kecamatanIdentitas" class="form-control" disabled>
                                        <option value=""> -- Pilih Kecamatan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kelurahan *</label>
                                    <select name="idKelurahanIdentitas" id="kelurahanIdentitas" class="form-control" disabled>
                                        <option value=""> -- Pilih Kelurahan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kode Pos *</label>
                                    <input type="text" class="form-control" name="kodeposSalesalamatIdentitas" value="<?= $data_sales_alamat_identitas['kodeposSalesalamat'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Alamat *</label>
                                    <textarea name="alamatSalesIdentitas" id="" class="form-control"><?= $data_sales_alamat_identitas['alamatSales'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Legalitas -->
                        <div class="row mt-3">
                            <h5>Data Legalitas PIC Internal</h5>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Unggah NPWP </label>
                                    <input type="file" class="form-control" name="fileNPWP">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">NPWP </label>
                                    <input type="text" class="form-control" name="noNPWP" value="<?= $group_legalitas_pic['isiLegalitas'] ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/sales-perorangan.js"></script>


</body>

</html>