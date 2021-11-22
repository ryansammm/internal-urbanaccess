<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <!-- <?php echo getcwd() ?> -->
    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/aktivasi/<?= $id ?>/store" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 col-2" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/aktivasi" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col-md-11 col-10">
                            <h4 class="card-title">Tambah Data Kelengkapan Aktivasi</h4>
                            <p style="font-size: 13px;">Aktivasi User</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Tanggal Aktivasi</label>
                                                <input type="date" class="form-control" name="tglAktivasi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nomor Registrasi</label>
                                                <input type="text" class="form-control" name="nomorRegistrasi" value="<?= $id ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama Layanan</label>
                                                <select name="idLayanan" id="layanan" class="form-select" readonly="readonly">
                                                    <?php foreach ($layanan as $key => $value) { ?>
                                                        <option <?= $value['idLayananinternet'] == $data_internet_user_layanan['idLayanan'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Kecepatan</label>
                                                <select name="idLayanandetail" id="kecepatan" class="form-control" readonly="readonly">
                                                    <?php foreach ($layanan_detail as $key => $value) { ?>
                                                        <option <?= $value['idLayananinternetdetail'] == $data_internet_user_layanan['idLayanandetail'] ? 'selected' : '' ?> value="<?= $value['idLayananinternetdetail'] ?>"><?= $value['kecepatan'] ?> Mbps</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">VLan</label>
                                                <input type="text" class="form-control" name="vlan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">MAC Address</label>
                                                <input type="text" class="form-control" name="macAddress" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Serial Number</label>
                                                <input type="text" class="form-control" name="serialNumber" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">IP Public/Private</label>
                                                <select name="jenisIp" id="" class="form-select" required>
                                                    <option value="">-- Pilih Jenis IP --</option>
                                                    <option value="1">IP Public</option>
                                                    <option value="2">IP Private</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row mt-3">
                                        <div action="/target" class="dropzone" id="my-great-dropzone"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
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

<!-- Dropzone -->
<script src="/plugins/dropzone/dropzone.js"></script>

<script>
    $(document).ready(function() {

    })
</script>

<!-- <script>
    Dropzone.options.myGreatDropzone = { // camelized version of the `id`
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        accept: function(file, done) {
            if (file) {
                done("Naha, you don't.");
                console.log(file);
            } else {
                done();
            }
        }
    };
</script> -->

</body>

</html>