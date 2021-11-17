<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-1" style="padding-top: 3pt; padding-left: 21pt;">
                        <a href="/kecepatan-internet" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="col">
                        <h4 class="card-title">Tambah Kecepatan Internet</h4>
                        <p style="font-size: 13px;">Kecepatan Internet</p>
                    </div>
                </div>
                <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                <form class="form form-vertical" method="post" action="/kecepatan-internet/store" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Layanan *</label>
                                    <select name="idLayananinternet" class="form-control">
                                        <option value="">Pilih Layanan</option>
                                        <?php foreach ($layanan_internet as $key => $value) { ?>
                                            <option value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kecepatan *</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="kecepatan" class="form-control">
                                        <span class="input-group-text">Mbps</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="first-name-vertical">Biaya Dasar *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" min="1" class="form-control" name="biayadasarbulanan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="first-name-vertical">PPN *</label>
                                    <select name="ppn" class="form-control">
                                        <option value="1">Ya</option>
                                        <option value="2" selected>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Biaya Bulanan *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" min="1" class="form-control" name="biayabulanan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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

<script>
    $(document).ready(function() {

    })
</script>
</body>

</html>