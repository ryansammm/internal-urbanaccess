<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <header>
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <a href="./" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="col">
                        <h4 class="card-title">Form Tambah Data User</h4>
                        <p style="font-size: 13px;">Data User</p>
                    </div>
                </div>
                <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                <form class="form form-vertical" method="post" action="/minat/store" enctype="multipart/form-data">
                    <div class="form-body">


                        <!-- Layanan -->
                        <h5>Pilih Layanan</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td><label for="first-name-vertical">Layanan *</label></td>
                                                <td><label for="first-name-vertical">Kecepatan *</label></td>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-select" name="" id="">
                                                        <option value="">Kesatu</option>
                                                        <option value="">Kedua</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select class="form-select" name="" id="">
                                                        <option value="">Kesatu</option>
                                                        <option value="">Kedua</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- Pilih Sales -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Pilih Sales *</label>
                                    <select name="" id="" class="form-select">
                                        <option value="">Kesatu</option>
                                        <option value="">Kedua</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Biaya Registrasi</td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Bulanan</td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tagihan </td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <!-- Data Pelanggan -->
                        <h5>Data Pelanggan</h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kode Form *</label>
                                    <input type="text" class="form-control" name="kodeMinat" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Jenis User *</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Kesatu</option>
                                        <option value="">Kedua</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Tanggal Registrasi *</label>
                                    <input type="date" class="form-control" name="namaPemohon">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="first-name-vertical">User ID *</label>
                                    <input type="text" class="form-control" name="kodeMinat" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Nama Penanggung Jawab *</label>
                                    <input type="text" class="form-control" name="namaPemohon">
                                </div>
                            </div>
                        </div>

                        <!-- Data Kontak Reseller -->
                        <h5>Kontak Pelanggan</h5>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">No. Telp *</label>
                                    <input type="text" class="form-control" name="kodeMinat" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Whatsapp *</label>
                                    <input type="text" class="form-control" name="namaPemohon">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Email *</label>
                                    <input type="text" class="form-control" name="namaPemohon">
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Pemasangan -->
                        <h5>Alamat Pemasangan</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Provinsi *</label>
                                    <select name="idProvinsi" id="provinsi" class="form-select">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kabupaten *</label>
                                    <select name="idKabupaten" id="kabupaten" class="form-select" disabled>
                                        <option value=""> -- Pilih Kabupaten -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kecamatan *</label>
                                    <select name="idKecamatan" id="kecamatan" class="form-select" disabled>
                                        <option value=""> -- Pilih Kecamatan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kelurahan *</label>
                                    <select name="idKelurahan" id="kelurahan" class="form-select" disabled>
                                        <option value=""> -- Pilih Kelurahan -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="first-name-vertical">Kode Pos *</label>
                                    <input type="text" class="form-control" name="kodepos">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="first-name-vertical">RT *</label>
                                    <input type="text" class="form-control" name="rt">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="first-name-vertical">RW *</label>
                                    <input type="text" class="form-control" name="rw">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="first-name-vertical">Koordinat</label>
                                    <input type="text" class="form-control" name="koordinat">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first-name-vertical">Alamat *</label>
                                    <textarea name="alamat" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Data PIC Internal -->
                        <h5>Data PIC Internal</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nama PIC Internal *</label>
                                                <input type="text" class="form-control" name="whatsappkontak">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Data Kontak Internal *</label>
                                                <textarea name="" id="" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Legalitas -->
                        <div class="row mt-3">
                            <h5>Persyaratan</h5>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">Unggah NPWP </label>
                                    <input type="file" class="form-control" name="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="first-name-vertical">NPWP </label>
                                    <input type="text" class="form-control" name="whatsappkontak">
                                </div>
                            </div>
                        </div>

                        <!-- Data Vendor -->
                        <h5>Data Vendor</h5>
                        <div class="row">
                            <div class="col">
                                <form action="" class="form-group">
                                    <table class="table table-border">
                                        <thead>
                                            <tr>
                                                <td>Nama Vendor</td>
                                                <td>Jenis</td>
                                                <td>Media Koneksi</td>
                                                <td>Biaya Registrasi</td>
                                                <td>Biaya Bulanan</td>
                                                <td>Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="" id="" class="form-select">
                                                        <option value="">Pertama</option>
                                                        <option value="">Kedua</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="form-select">
                                                        <option value="">Pertama</option>
                                                        <option value="">Kedua</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="" id="" class="form-select">
                                                        <option value="">Pertama</option>
                                                        <option value="">Kedua</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">RP.</span>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">RP.</span>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" style="font-size: 15pt;">
                                                        <i class="bi bi-dash"></i>
                                                    </a>
                                                    <a href="" style="font-size: 15pt;" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                        <i class="bi bi-gear-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>

                        <!-- Detail -->
                        <div class="row">
                            <div class="col-8">
                                <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                    </svg> Tambah Data</button>
                            </div>
                            <div class="col-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Biaya Registrasi</td>
                                        <td>:</td>
                                        <td><a href=""><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                    <tr>
                                        <td>PPN Biaya Registrasi</td>
                                        <td>:</td>
                                        <td><a href=""><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Bulanan</td>
                                        <td>:</td>
                                        <td><a href=""><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                    <tr>
                                        <td>PPN Biaya Bulanan</td>
                                        <td>:</td>
                                        <td><a href=""><span>RP.</span>1.000.000</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary  float-end">Submit</button>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>


<!-- Modal 1 -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="first-name-vertical">PPN Biaya Instalasi</label>
                        <select name="" id="" class="form-select">
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="first-name-vertical">PPN Biaya Bulanan</label>
                        <select name="" id="" class="form-select">
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal 2 -->
<div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>

<script src=" /assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>
<script src="/assets/js/minat.js"></script>


</body>

</html>