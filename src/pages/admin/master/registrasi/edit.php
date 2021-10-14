<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/registrasi-user/<?= $detail['noRegistrasi'] ?>/update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/registrasi-user" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Form Ubah Data User</h4>
                            <p style="font-size: 13px;">Data User</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>

                    <div class="form-body">


                        <!-- Layanan -->
                        <h5>Pilih Layanan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Layanan *</label>
                                        <select name="idLayanan" id="layanan" class="form-control">
                                            <?php foreach ($layanan as $key => $value) { ?>
                                                <option <?= $value['idLayananinternet'] == $data_internet_user_layanan['idLayanan'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecepatan *</label>
                                        <select name="idLayanandetail" id="kecepatan" class="form-control">
                                            <?php foreach ($layanan_detail as $key => $value) { ?>
                                                <option <?= $value['idLayananinternet'] == $data_internet_user_layanan['idLayananinternet'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['kecepatan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Pilih Sales *</label>
                                        <select name="idSales" id="" class="form-select">
                                            <?php foreach ($data_sales as $key => $value) { ?>
                                                <option <?= $value['idSales'] == $detail['idSales'] ? 'selected' : '' ?> value="<?= $value['idSales'] ?>"><?= $value['namaSales'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Fee Sales</label>
                                        <div class="input-group">
                                            <span class="input-group-text">RP.</span>
                                            <input type="text" class="form-control number" name="feeSales">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Data Pelanggan -->
                        <h5 class="mt-3">Data Pelanggan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Form *</label>
                                        <input type="text" class="form-control" name="kodeformInternetregistrasi" value="<?= $detail['kodeformInternetregistrasi'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jenis User *</label>
                                        <select name="jenisuserRegistrasi" id="" class="form-control">
                                            <option value=""> -- Pilih Jenis User -- </option>
                                            <option value="1" <?= $detail['jenisuserRegistrasi'] == 1 ? "selected" : "" ?>>Perorangan</option>
                                            <option value="2" <?= $detail['jenisuserRegistrasi'] == 2 ? "selected" : "" ?>>Instansi Swasta / Korporasi</option>
                                            <option value="3" <?= $detail['jenisuserRegistrasi'] == 3 ? "selected" : "" ?>>Kedinasan</option>
                                            <option value="4" <?= $detail['jenisuserRegistrasi'] == 4 ? "selected" : "" ?>>Mitra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tanggal Registrasi *</label>
                                        <input type="date" class="form-control" name="tanggalRegistrasi" value="<?= date("Y-m-d") ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">User ID *</label>
                                        <input type="text" class="form-control" name="idUser" value="<?= $detail['idUser'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama Penanggung Jawab *</label>
                                        <input type="text" class="form-control" name="namauserRegistrasi" value="<?= $detail['namauserRegistrasi'] ?>">
                                    </div>
                                </div>
                            </div>

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
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah Foto KTP</label>
                                        <input type="file" class="form-control" name="fileKTP" id="file" onchange="Filevalidation()">
                                        <span class="text-danger" style="font-size: 10pt;" id="errorFile"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Pemasangan -->
                        <h5 class="mt-3">Alamat Pemasangan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Provinsi *</label>
                                        <select name="idProvinsi" id="provinsi" class="form-select">
                                            <option value="">-- Pilih Provinsi --</option>
                                            <?php foreach ($provinsi as $key => $value) { ?>
                                                <option <?= $value['id'] == $detail['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
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
                                        <input type="text" class="form-control" name="kodepos" value="<?= $detail['kodepos'] ?>">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RT *</label>
                                        <input type="text" class="form-control" name="rt" value="<?= $detail['rt'] ?>">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RW *</label>
                                        <input type="text" class="form-control" name="rw" value="<?= $detail['rw'] ?>">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Koordinat</label>
                                        <input type="text" id="koordinat" class="form-control" name="koordinat" value="<?= $detail['latitude'] ?>,<?= $detail['longtitude'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamat" id="" class="form-control"><?= $detail['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data PIC Internal -->
                        <h5 class="mt-3">Data PIC Internal</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NIK PIC</label>
                                        <input type="text" class="form-control" name="nikPic" value="<?= $detail['nikPic'] ?>">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Internal </label>
                                        <input type="text" class="form-control" name="namaPic" value="<?= $detail['namaPic'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control" name="noTelpPIC" value="<?= $data_kontak_telp_pic['isiKontak'] ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control" name="noWaPIC" value="<?= $data_kontak_whatsapp_pic['isiKontak'] ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control" name="emailPIC" value="<?= $data_kontak_email_pic['isiKontak'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Legalitas -->
                        <h5 class="mt-3">Persyaratan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah NPWP </label>
                                        <input type="file" class="form-control" name="fileNPWP" id="file" onchange="Filevalidation()">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NPWP </label>
                                        <input type="text" class="form-control" name="noNPWP" id="file" value="<?= $data_legalitas_vendor['isiLegalitas'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="errorFile"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Vendor -->
                        <h5 class="mt-3">Data Vendor</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama Vendor</label>
                                        <select name="idVendor" id="" class="form-select">
                                            <option value="">Pilih Vendor</option>
                                            <?php foreach ($data_vendor as $key => $value) { ?>
                                                <option <?= $value['idVendor'] == $data_internet_user_vendor['idVendor'] ? 'selected' : '' ?> value="<?= $value['idVendor'] ?>"><?= $value['namaVendor'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jenis</label>
                                        <select name="jenislinkVendor" id="" class="form-select">
                                            <option value="1" <?= $data_internet_user_vendor['jenislinkVendor'] == 1 ? "selected" : "" ?>>Link Utama</option>
                                            <option value="2" <?= $data_internet_user_vendor['jenislinkVendor'] == 2 ? "selected" : "" ?>>Link Backup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Media Koneksi</label>
                                        <select name="mediakoneksiVendor" id="" class="form-select">
                                            <option value="1" <?= $data_internet_user_vendor['mediakoneksiVendor'] == 1 ? "selected" : "" ?>>Fiber Optic</option>
                                            <option value="2" <?= $data_internet_user_vendor['mediakoneksiVendor'] == 2 ? "selected" : "" ?>>Wireless</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Biaya Registrasi</label>
                                        <div class="input-group">
                                            <span class="input-group-text">RP.</span>
                                            <input type="text" class="form-control number" name="biayaregistrasiLayanan" value="<?= $data_internet_user_layanan['biayaregistrasiLayanan'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Registrasi</label>
                                        <select name="ppnbiayainstalasi" id="" class="form-select">
                                            <option value="1" <?= $data_internet_user_vendor['ppnbiayainstalasi'] == 1 ? "selected" : "" ?>>Ya</option>
                                            <option value="2" <?= $data_internet_user_vendor['ppnbiayainstalasi'] == 2 ? "selected" : "" ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Biaya Bulanan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">RP.</span>
                                            <input type="text" class="form-control number" name="biayabulananLayanan" value="<?= $data_internet_user_layanan['biayabulananLayanan'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Bulanan</label>
                                        <select name="ppnbiayabulanan" id="" class="form-select">
                                            <option value="">PPN Biaya Bulanan</option>
                                            <option value="1" <?= $data_internet_user_vendor['ppnbiayabulanan'] == 1 ? "selected" : "" ?>>Ya</option>
                                            <option value="2" <?= $data_internet_user_vendor['ppnbiayabulanan'] == 2 ? "selected" : "" ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Detail -->
                        <!-- <div class="row"> -->
                        <!-- <div class="col-8">
                                <button type="button" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                    </svg> Tambah Data
                                </button>
                            </div> -->
                        <!-- <div class="col-4">
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
                            </div> -->
                        <!-- </div> -->

                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
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

        $('input.number').keyup(function(event) {

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            });
        });
    });
</script>


</body>

</html>