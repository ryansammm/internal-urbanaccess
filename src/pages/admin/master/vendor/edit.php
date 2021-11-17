<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/vendor/<?= $detail['idVendor'] ?>/update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <a href="/vendor" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Form Edit Vendor</h4>
                            <p style="font-size: 13px;">Data Vendor</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="form-body">

                        <!-- Data Pemohon -->
                        <h5>Data Vendor</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Vendor *</label>
                                        <input type="text" class="form-control" name="kodeVendor" value="<?= $detail['kodeVendor'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama Vendor *</label>
                                        <input type="text" class="form-control" name="namaVendor" value="<?= $detail['namaVendor'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Kontak Vendor -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp *</label>
                                        <input type="text" class="form-control" name="noTelpVendor" value="<?= $data_kontak_telp_vendor['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp *</label>
                                        <input type="text" class="form-control" name="noWaVendor" value="<?= $data_kontak_whatsapp_vendor['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email *</label>
                                        <input type="text" class="form-control" name="emailVendor" value="<?= $data_kontak_email_vendor['isiKontak'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat Saat Ini -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Provinsi *</label>
                                        <select name="idProvinsi" id="provinsi" class="form-control" required>
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($data_provinsi as $key => $value) { ?>
                                                <option <?= $value['id'] == $detail['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kabupaten *</label>
                                        <select name="idKabupaten" id="kabupaten" class="form-control" disabled required>
                                            <option value=""> -- Pilih Kabupaten -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecamatan *</label>
                                        <select name="idKecamatan" id="kecamatan" class="form-control" disabled required>
                                            <option value=""> -- Pilih Kecamatan -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kelurahan *</label>
                                        <select name="idKelurahan" id="kelurahan" class="form-control" disabled required>
                                            <option value=""> -- Pilih Kelurahan -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Pos *</label>
                                        <input type="text" class="form-control" name="kodeposVendor" value="<?= $detail['kodeposVendor'] ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamatVendor" id="" class="form-control" required><?= $detail['alamatVendor'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah NPWP </label>
                                        <input type="file" class="form-control" name="fileNPWPVendor">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NPWP </label>
                                        <input type="text" class="form-control" name="noNPWPVendor" value="<?= $group_legalitas_vendor['isiLegalitas'] ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data PIC Internal -->
                        <h5 class="mt-3">Data PIC Internal</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NIK PIC Internal *</label>
                                        <input type="text" class="form-control" name="nikPic" value="<?= $detail['nikPic'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Internal *</label>
                                        <input type="text" class="form-control" name="namaPic" value="<?= $detail['namaPic'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control" name="noTelpPIC" value="<?= $data_kontak_telp_pic['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control" name="noWaPIC" value="<?= $data_kontak_whatsapp_pic['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control" name="emailPIC" value="<?= $data_kontak_email_pic['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah NPWP </label>
                                        <input type="file" class="form-control" name="fileNPWPPIC">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NPWP </label>
                                        <input type="text" class="form-control" name="noNPWPPIC" value="<?= $group_legalitas_pic['isiLegalitas'] ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
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
<script src="/assets/js/vendor.js"></script>


</body>

</html>