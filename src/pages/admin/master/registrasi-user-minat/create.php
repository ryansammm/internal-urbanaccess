<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <form class="form form-vertical" method="post" action="/registrasi-user-minat/<?= $data_minat['kodeMinat'] ?>/store" enctype="multipart/form-data">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="padding-top: 3pt; padding-left: 21pt;">
                            <a href="/registrasi-user" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Form Tambah Data User</h4>
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
                                        <select name="idLayanan" id="layanan" class="form-select" required>
                                            <option value="">-- Pilih Layanan --</option>
                                            <?php foreach ($layanan as $key => $value) { ?>
                                                <option <?= $value['idLayananinternet'] == $data_minat_layanan['idLayanan'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['namaLayanan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecepatan *</label>
                                        <select name="idLayanandetail" id="kecepatan" class="form-select" required>
                                            <?php foreach ($layanan_detail as $key => $value) { ?>
                                                <option <?= $value['idLayananinternet'] == $value['idLayananinternet'] ? 'selected' : '' ?> value="<?= $value['idLayananinternet'] ?>"><?= $value['kecepatan'] ?> Mbps</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Pilih Sales *</label>
                                        <select name="idSales" id="" class="form-select">
                                            <?php foreach ($data_sales as $key => $value) { ?>
                                                <option <?= $value['idSales'] == $data_minat['idSales'] ? 'selected' : '' ?> value="<?= $value['idSales'] ?>"><?= $value['namaSales'] ?></option>
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


                        <!-- <div class="row">
                            <div class="col-4">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Biaya Registrasi</td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>Rp.</span><span class="biayaRegistrasi"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Bulanan</td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>Rp.</span><span class="biayaBulanan"></span></a></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Tagihan </td>
                                        <td>:</td>
                                        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal2"><span>Rp.</span><span class="biayaTotal"></span></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div> -->

                        <!-- Data Pelanggan -->
                        <h5 class="mt-3">Data Pelanggan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Form *</label>
                                        <input type="text" class="form-control" name="kodeformInternetregistrasi" value="<?= $kode_form ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jenis User *</label>
                                        <select name="jenisuserRegistrasi" id="" class="form-control">
                                            <option value=""> -- Pilih Jenis User -- </option>
                                            <option value="1">Perorangan</option>
                                            <option value="2">Instansi Swasta / Korporasi</option>
                                            <option value="3">Kedinasan</option>
                                            <option value="4">Mitra</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tanggal Registrasi *</label>
                                        <input type="date" class="form-control" name="tanggalRegistrasi" value="<?= date("Y-m-d") ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">User ID *</label>
                                        <input type="text" class="form-control" name="idUser" value="<?= $data_minat['namapemohon'] . "_" . $data_minat['alamat'] ?>" required>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama Penanggung Jawab *</label>
                                        <input type="text" class="form-control" name="namauserRegistrasi" value="<?= $data_minat['namapemohon'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp *</label>
                                        <input type="text" class="form-control" name="telpkontak" value="<?= $data_kontak_telp['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp *</label>
                                        <input type="text" class="form-control" name="whatsappkontak" value="<?= $data_kontak_whatsapp['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email *</label>
                                        <input type="text" class="form-control" name="emailkontak" value="<?= $data_kontak_email['isiKontak'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NIK </label>
                                        <input type="text" class="form-control" name="nikUserRegistrasi">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah Foto KTP</label>
                                        <input type="file" class="form-control" name="fileKTP" id="file" onchange="Filevalidation()">
                                        <span class="text-danger" style="font-size: 10pt;" id="errorFile"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NPWP </label>
                                        <input type="text" class="form-control" name="noNPWP">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Unggah NPWP </label>
                                        <input type="file" class="form-control" name="fileNPWP" id="file" onchange="Filevalidation()">
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
                                        <select name="idProvinsiPemasangan" id="provinsi" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($provinsi as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kabupaten *</label>
                                        <select name="idKabupatenPemasangan" id="kabupaten" class="form-select">
                                            <option value=""> -- Pilih Kabupaten -- </option>
                                            <?php foreach ($data_kabupaten as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKabupaten'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecamatan *</label>
                                        <select name="idKecamatanPemasangan" id="kecamatan" class="form-select">
                                            <option value=""> -- Pilih Kecamatan -- </option>
                                            <?php foreach ($data_kecamatan as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKecamatan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kelurahan *</label>
                                        <select name="idKelurahanPemasangan" id="kelurahan" class="form-select">
                                            <option value=""> -- Pilih Kelurahan -- </option>
                                            <?php foreach ($data_kelurahan as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKelurahan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Pos *</label>
                                        <input type="text" class="form-control" name="kodeposPemasangan" value="<?= $data_minat['kodepos'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RT *</label>
                                        <input type="text" class="form-control" name="rtPemasangan" value="<?= $data_minat['rt'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RW *</label>
                                        <input type="text" class="form-control" name="rwPemasangan" value="<?= $data_minat['rw'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Koordinat</label>
                                        <input type="text" class="form-control" name="koordinatPemasangan" id="koordinat" value="<?= $data_minat['latitude'] ?>,<?= $data_minat['longtitude'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamatPemasangan" id="" class="form-control" required><?= $data_minat['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Penagihan -->
                        <h5 class="mt-3">Alamat Penagihan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Provinsi *</label>
                                        <select name="idProvinsiPenagihan" id="provinsiPenagihan" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($provinsi as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kabupaten *</label>
                                        <select name="idKabupatenPenagihan" id="kabupatenPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kabupaten -- </option>
                                            <?php foreach ($data_kabupaten as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKabupaten'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecamatan *</label>
                                        <select name="idKecamatanPenagihan" id="kecamatanPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kecamatan -- </option>
                                            <?php foreach ($data_kecamatan as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKecamatan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kelurahan *</label>
                                        <select name="idKelurahanPenagihan" id="kelurahanPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kelurahan -- </option>
                                            <?php foreach ($data_kelurahan as $key => $value) { ?>
                                                <option <?= $value['id'] == $data_minat['idKelurahan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Pos *</label>
                                        <input type="text" class="form-control" name="kodeposPenagihan" value="<?= $data_minat['kodepos'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RT *</label>
                                        <input type="text" class="form-control" name="rtPenagihan" value="<?= $data_minat['rt'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RW *</label>
                                        <input type="text" class="form-control" name="rwPenagihan" value="<?= $data_minat['rw'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Koordinat</label>
                                        <input type="text" class="form-control" name="koordinatPenagihan" id="koordinat" value="<?= $data_minat['latitude'] ?>,<?= $data_minat['longtitude'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamatPenagihan" id="" class="form-control" required><?= $data_minat['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Metode Pengiriman invoice -->
                        <h5 class="mt-3">Metode Pengiriman Invoice</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Softcopy</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Hardcopy</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio3" value="3">
                                        <label class="form-check-label" for="inlineRadio3">Softcopy & Hardcopy</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data PIC Keuangan -->
                        <h5 class="mt-3">Data PIC Keuangan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NIK PIC Keuangan</label>
                                        <input type="text" class="form-control" name="nikPicKeuangan" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Keuangan </label>
                                        <input type="text" class="form-control" name="namaPicKeuangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control" name="noTelpPICKeuangan" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control" name="noWaPICKeuangan" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control" name="emailPICKeuangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="cekKeuangan">
                                        <label class="form-check-label" for="cekKeuangan">
                                            Data yang digunakan sama
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data PIC Teknis -->
                        <h5 class="mt-3">Data PIC Teknis</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">NIK PIC Teknis</label>
                                        <input type="text" class="form-control" name="nikPicTeknis" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Teknis </label>
                                        <input type="text" class="form-control" name="namaPicTeknis" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control" name="noTelpPICTeknis" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control" name="noWaPICTeknis" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control" name="emailPICTeknis" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="cekTeknis">
                                        <label class="form-check-label" for="cekTeknis">
                                            Data yang digunakan sama
                                        </label>
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
                                            <?php foreach ($data_vendor as $key => $value) { ?>
                                                <option <?= $value['idVendor'] == $data_user_requset_survey[0]['idVendor'] ? 'selected' : '' ?> value="<?= $value['idVendor'] ?>"><?= $value['namaVendor'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jenis</label>
                                        <select name="jenislinkVendor" id="" class="form-select" required>
                                            <option value="">-- Pilih Jenis Link --</option>
                                            <option value="1">Link Utama</option>
                                            <option value="2">Link Backup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Media Koneksi</label>
                                        <select name="mediakoneksiVendor" id="" class="form-select" required>
                                            <option value="">-- Pilih Media Koneksi --</option>
                                            <option value="1">Fiber Optic</option>
                                            <option value="2">Wireless</option>
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
                                            <input type="text" class="form-control number" name="biayaregistrasiLayanan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Registrasi</label>
                                        <select name="ppnbiayainstalasi" id="" class="form-select" required>
                                            <option value="">-- PPN --</option>
                                            <option value="1">Ya</option>
                                            <option value="2">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Biaya Bulanan</label>
                                        <div class="input-group">
                                            <span class="input-group-text">RP.</span>
                                            <input type="text" class="form-control number" name="biayabulananLayanan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Bulanan</label>
                                        <select name="ppnbiayabulanan" id="" class="form-select" required>
                                            <option value="">-- PPN --</option>
                                            <option value="1">Ya</option>
                                            <option value="2">Tidak</option>
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


                        <!-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <table class="table table-border">
                                        <thead>
                                            <tr>
                                                <td>Nama Vendor</td>
                                                <td>Jenis</td>
                                                <td>Media Koneksi</td>
                                                <td>Biaya Registrasi</td>
                                                <td>Biaya Bulanan</td> -->
                        <!-- <td>Aksi</td> -->
                        <!-- </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="idVendor" id="" class="form-select">
                                                        <?php foreach ($data_vendor as $key => $value) { ?>
                                                            <option <?= $value['idVendor'] == $data_user_requset_survey[0]['idVendor'] ? 'selected' : '' ?> value="<?= $value['idVendor'] ?>"><?= $value['namaVendor'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="jenislinkVendor" id="" class="form-select">
                                                        <option value="1">Link Utama</option>
                                                        <option value="2">Link Backup</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="mediakoneksiVendor" id="" class="form-select">
                                                        <option value="1">Fiber Optic</option>
                                                        <option value="2">Wireless</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">RP.</span>
                                                        <input type="text" class="form-control" name="biayaregistrasiLayanan">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-text">RP.</span>
                                                        <input type="text" class="form-control" name="biayabulananLayanan">
                                                    </div>
                                                </td> -->
                        <!-- <td>
                                                    <a href="" style="font-size: 15pt;">
                                                        <i class="bi bi-dash"></i>
                                                    </a>
                                                    <a href="" style="font-size: 15pt;" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                        <i class="bi bi-gear-fill"></i>
                                                    </a>
                                                </td> -->
                        <!-- </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <select name="ppnbiayainstalasi" id="" class="form-select">
                                    <option value="">PPN Biaya Instalasi</option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </td>
                            <td>
                                <select name="ppnbiayabulanan" id="" class="form-select">
                                    <option value="">PPN Biaya Bulanan</option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                         </div>
                    </div> -->

                        <!-- Detail -->
                        <!-- <div class="row">
                            <div class="col-8">
                                <button type="button" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                    </svg> Tambah Data
                                </button>
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
                        </div> -->

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary  float-end">Submit</button>
                </div>
            </div>

    </div>
    </form>

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

<script>
    var optionKabupaten = "";
    $("#provinsiPenagihan").on("change", function() {
        optionKabupaten = '<option value="">Pilih Kabupaten</option>';
        if ($(this).val() != "") {
            $.ajax({
                url: "/kabupaten/get/" + $(this).val(),
                method: "get",
            }).done(function(data) {
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    optionKabupaten +=
                        '<option value="' + element.id + '">' + element.name + "</option>";
                }
                $("#kabupatenPenagihan").html(optionKabupaten);
                $("#kabupatenPenagihan").prop("disabled", false);
            });
        }
    });

    var optionKecamatan = "";
    $("#kabupatenPenagihan").on("change", function() {
        optionKecamatan = '<option value="">Pilih Kecamatan</option>';
        if ($(this).val() != "") {
            $.ajax({
                url: "/kecamatan/get/" + $(this).val(),
                method: "get",
            }).done(function(data) {
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    optionKecamatan +=
                        '<option value="' + element.id + '">' + element.name + "</option>";
                }
                $("#kecamatanPenagihan").html(optionKecamatan);
                $("#kecamatanPenagihan").prop("disabled", false);
            });
        }
    });

    var optionKelurahan = "";
    $("#kecamatanPenagihan").on("change", function() {
        optionKelurahan = '<option value="">Pilih Kelurahan</option>';
        if ($(this).val() != "") {
            $.ajax({
                url: "/kelurahan/get/" + $(this).val(),
                method: "get",
            }).done(function(data) {
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    optionKelurahan +=
                        '<option value="' + element.id + '">' + element.name + "</option>";
                }
                $("#kelurahanPenagihan").html(optionKelurahan);
                $("#kelurahanPenagihan").prop("disabled", false);
            });
        }
    });
</script>

</body>

</html>