<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">

            <form class="form form-vertical" id="qual" method="post" action="/minat/store" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/minat" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>

                        </div>
                        <div class="col-md-11">
                            <h4 class="card-title">Tambah Data Minat</h4>
                            <p style="font-size: 13px;">Data Minat</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="form-body">
                        <h5>Data Pemohon</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Minat *</label>
                                                <input type="text" class="form-control" name="kodeMinat" value="<?= $kode_minat ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Pemohon *</label>
                                                <input type="text" class="form-control" name="namaPemohon" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Lokasi</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Provinsi *</label>
                                                <select name="idProvinsi" id="provinsi" class="form-control" required>
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($provinsi as $key => $value) { ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kabupaten *</label>
                                                <select name="idKabupaten" id="kabupaten" class="form-control" disabled required>
                                                    <option value=""> -- Pilih Kabupaten -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecamatan *</label>
                                                <select name="idKecamatan" id="kecamatan" class="form-control" disabled required>
                                                    <option value=""> -- Pilih Kecamatan -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kelurahan *</label>
                                                <select name="idKelurahan" id="kelurahan" class="form-control" disabled required>
                                                    <option value=""> -- Pilih Kelurahan -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kode Pos *</label>
                                                <input type="text" class="form-control" name="kodepos" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="first-name-vertical">RT *</label>
                                                <input type="text" class="form-control" name="rt" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="first-name-vertical">RW *</label>
                                                <input type="text" class="form-control" name="rw" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Koordinat</label>
                                                <input type="text" class="form-control" name="koordinat" id="koordinat" required>
                                                <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Alamat *</label>
                                                <textarea name="alamat" id="" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Kontak</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">No. Telp *</label>
                                                <input type="text" class="form-control" name="telpkontak" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Whatsapp *</label>
                                                <input type="text" class="form-control" name="whatsappkontak" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Email *</label>
                                                <input type="text" class="form-control" name="emailkontak" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Layanan</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Layanan</label>
                                                <select name="idLayanan" id="layanan" class="form-control" required>
                                                    <option value="">Pilih Layanan</option>
                                                    <?php foreach ($layanan as $key => $value) { ?>
                                                        <option value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecepatan</label>
                                                <select name="idLayanandetail" id="kecepatan" class="form-control" disabled required>
                                                    <option value="">Pilih Detail Layanan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Sales</label>
                                                <select name="idSales" id="data_sales" class="form-control" required>
                                                    <option value="">Pilih Sales</option>
                                                    <?php foreach ($data_sales as $key => $value) { ?>
                                                        <option value="<?= $value['idSales'] ?>"><?= $value['namaSales'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Upload Foto</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Foto Lokasi</label>
                                                <input type="file" class="form-control" name="fotolokasi" id="file" onchange="Filevalidation()">
                                                <span class="text-danger" style="font-size: 10pt;" id="errorFile"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
<script src="/assets/js/minat.js"></script>
<script src="/assets/js/validate.js"></script>

<script>
    $(document).ready(function() {

        $('#koordinat').on("focusout", function() {
            var koordinat = $(this).val();
            if (!koordinat.includes(',')) {
                $('#error').html("Format Salah. Contoh: Latitude(koma)Longtitude ");
                document.getElementById("koordinat").value = '';
            } else {
                $('#error').html("");
            }
        });

    });
</script>

<script>
    Filevalidation = () => {
        const fi = document.getElementById('file');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {

                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 2048) {
                    $('#errorFile').html("File terlalu besar, file harus kurang dari 2mb");
                    fi.value = '';
                } else {
                    document.getElementById('size').innerHTML = '<b>' +
                        file + '</b> KB';
                }
            }
        }
    }
</script>

</body>

</html>