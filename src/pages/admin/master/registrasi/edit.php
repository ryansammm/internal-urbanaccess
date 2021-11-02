<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">

    <div class="card">
        <form class="form form-vertical" method="post" action="/registrasi-user/<?= $detail['noRegistrasi'] ?>/update" enctype="multipart/form-data">
            <div class="card-content">
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
                                                <option <?= $value['idLayananinternetdetail'] == $data_internet_user_layanan['idLayanandetail'] ? 'selected' : '' ?> value="<?= $value['idLayananinternetdetail'] ?>"><?= $value['kecepatan'] ?> Mbps</option>
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
                                            <input type="text" class="form-control number" name="feeSales" value="<?= $data_feesales['feeSales'] ?>">
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
                                        <input type="text" class="form-control namauserRegistrasi" name="namauserRegistrasi" value="<?= $detail['namauserRegistrasi'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp *</label>
                                        <input type="text" class="form-control telpkontakuser" name="telpkontak" value="<?= $data_kontak_telp['isiKontak'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp *</label>
                                        <input type="text" class="form-control whatsappkontakuser" name="whatsappkontak" value="<?= $data_kontak_whatsapp['isiKontak'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email *</label>
                                        <input type="text" class="form-control emailkontakuser" name="emailkontak" value="<?= $data_kontak_email['isiKontak'] ?>">
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
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nomor Induk Kependudukan</label>
                                        <input type="text" class="form-control nikUserRegistrasi" name="nikUserRegistrasi" value="<?= $detail['nikUserRegistrasi'] ?>">
                                    </div>
                                </div>
                            </div>
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

                        <h5 class="mt-3">Alamat Pemasangan</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Provinsi *</label>
                                        <select name="idProvinsiPemasangan" id="provinsi" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($data_provinsi_pemasangan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_pemasangan['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kabupaten *</label>
                                        <select name="idKabupatenPemasangan" id="kabupaten" class="form-select">
                                            <option value=""> -- Pilih Kabupaten -- </option>
                                            <?php foreach ($data_kabupaten_pemasangan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_pemasangan['idKabupaten'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecamatan *</label>
                                        <select name="idKecamatanPemasangan" id="kecamatan" class="form-select">
                                            <option value=""> -- Pilih Kecamatan -- </option>
                                            <?php foreach ($data_kecamatan_pemasangan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_pemasangan['idKecamatan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kelurahan *</label>
                                        <select name="idKelurahanPemasangan" id="kelurahan" class="form-select">
                                            <option value=""> -- Pilih Kelurahan -- </option>
                                            <?php foreach ($data_kelurahan_pemasangan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_pemasangan['idKelurahan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Pos *</label>
                                        <input type="text" class="form-control" name="kodeposPemasangan" value="<?= $alamat_pemasangan['kodepos'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RT *</label>
                                        <input type="text" class="form-control" name="rtPemasangan" value="<?= $alamat_pemasangan['rt'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RW *</label>
                                        <input type="text" class="form-control" name="rwPemasangan" value="<?= $alamat_pemasangan['rw'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Koordinat</label>
                                        <input type="text" class="form-control" name="koordinatPemasangan" id="koordinat" value="<?= $alamat_pemasangan['latitude'] ?>,<?= $alamat_pemasangan['longtitude'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamatPemasangan" id="" class="form-control" required><?= $alamat_pemasangan['alamat'] ?></textarea>
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
                                            <?php foreach ($data_provinsi_penagihan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_penagihan['idProvinsi'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kabupaten *</label>
                                        <select name="idKabupatenPenagihan" id="kabupatenPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kabupaten -- </option>
                                            <?php foreach ($data_kabupaten_penagihan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_penagihan['idKabupaten'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kecamatan *</label>
                                        <select name="idKecamatanPenagihan" id="kecamatanPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kecamatan -- </option>
                                            <?php foreach ($data_kecamatan_penagihan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_penagihan['idKecamatan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kelurahan *</label>
                                        <select name="idKelurahanPenagihan" id="kelurahanPenagihan" class="form-select">
                                            <option value=""> -- Pilih Kelurahan -- </option>
                                            <?php foreach ($data_kelurahan_penagihan as $key => $value) { ?>
                                                <option <?= $value['id'] == $alamat_penagihan['idKelurahan'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Kode Pos *</label>
                                        <input type="text" class="form-control" name="kodeposPenagihan" value="<?= $alamat_penagihan['kodepos'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RT *</label>
                                        <input type="text" class="form-control" name="rtPenagihan" value="<?= $alamat_penagihan['rt'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="first-name-vertical">RW *</label>
                                        <input type="text" class="form-control" name="rwPenagihan" value="<?= $alamat_penagihan['rw'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Koordinat</label>
                                        <input type="text" class="form-control" name="koordinatPenagihan" id="koordinat" value="<?= $alamat_penagihan['latitude'] ?>,<?= $alamat_penagihan['longtitude'] ?>">
                                        <span class="text-danger" style="font-size: 10pt;" id="error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Alamat *</label>
                                        <textarea name="alamatPenagihan" id="" class="form-control" required><?= $alamat_penagihan['alamat'] ?></textarea>
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
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio1" value="1" <?= $data_invoice['pengirimaninvoice'] == '1' ? 'checked' : ''  ?>>
                                        <label class="form-check-label" for="inlineRadio1">Softcopy</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio2" value="2" <?= $data_invoice['pengirimaninvoice'] == '2' ? 'checked' : ''  ?>>
                                        <label class="form-check-label" for="inlineRadio2">Hardcopy</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pengirimanInvoice" id="inlineRadio3" value="3" <?= $data_invoice['pengirimaninvoice'] == '3' ? 'checked' : ''  ?>>
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
                                        <input type="text" class="form-control nikPicKeuangan" name="nikPicKeuangan" value="<?= $data_group_pic_keuangan['nikPic'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Keuangan </label>
                                        <input type="text" class="form-control namaPicKeuangan" name="namaPicKeuangan" value="<?= $data_group_pic_keuangan['namaPic'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control noTelpPICKeuangan" name="noTelpPICKeuangan" value="<?= $data_kontak_telp_pic_keuangan['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control noWaPICKeuangan" name="noWaPICKeuangan" value="<?= $data_kontak_whatsapp_pic_keuangan['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control emailPICKeuangan" name="emailPICKeuangan" value="<?= $data_kontak_email_pic_keuangan['isiKontak'] ?>" required>
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
                                        <input type="text" class="form-control" name="nikPicTeknis" value="<?= $data_group_pic_teknis['nikPic'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama PIC Teknis </label>
                                        <input type="text" class="form-control" name="namaPicTeknis" value="<?= $data_group_pic_teknis['namaPic'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">No. Telp </label>
                                        <input type="text" class="form-control" name="noTelpPICTeknis" value="<?= $data_kontak_telp_pic_teknis['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Whatsapp </label>
                                        <input type="text" class="form-control" name="noWaPICTeknis" value="<?= $data_kontak_whatsapp_pic_teknis['isiKontak'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Email </label>
                                        <input type="text" class="form-control" name="emailPICTeknis" value="<?= $data_kontak_email_pic_teknis['isiKontak'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="cekTeknis">
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
                                        <select name="idVendor" id="" class="form-select" required>
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
                                        <select name="jenislinkVendor" id="" class="form-select" required>
                                            <option value="">-- Pilih Jenis Koneksi --</option>
                                            <option value="1" <?= $data_internet_user_vendor['jenislinkVendor'] == 1 ? "selected" : "" ?>>Link Utama</option>
                                            <option value="2" <?= $data_internet_user_vendor['jenislinkVendor'] == 2 ? "selected" : "" ?>>Link Backup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Media Koneksi</label>
                                        <select name="mediakoneksiVendor" id="" class="form-select" required>
                                            <option value="">-- Pilih Media Koneksi --</option>
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
                                            <input type="text" class="form-control number biayaregistrasiLayanan" name="biayaregistrasiLayanan" value="<?= $data_internet_user_layanan['biayaregistrasiLayanan'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Registrasi</label>
                                        <select name="ppnbiayainstalasi" id="" class="form-select ppnbiayainstalasi" required>
                                            <option value="">-- PPN --</option>
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
                                            <input type="text" class="form-control number biayabulananLayanan" name="biayabulananLayanan" value="<?= $data_internet_user_layanan['biayabulananLayanan'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">PPN Biaya Bulanan</label>
                                        <select name="ppnbiayabulanan" id="" class="form-select ppnbiayabulanan" required>
                                            <option value="">-- PPN --</option>
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
                                        <textarea class="form-control" name="keterangan" id="" cols="30" rows="4"><?= $detail['keterangan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Instalasi -->
                        <h5 class="mt-3">Data Instalasi</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tanggal Instalasi</label>
                                        <input type="date" class="form-control" name="tglInstalasi" value="<?= $data_instalasi['tglInstalasi'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jarak</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control number" name="jarak" value="<?= $data_instalasi['jarak'] ?>" required>
                                            <span class="input-group-text">Meter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-3">Data Aktivasi</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tanggal Aktivasi</label>
                                        <input type="date" class="form-control" name="tglAktivasi" value="<?= $data_aktivasi['tglAktivasi'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">VLan</label>
                                        <input type="text" class="form-control" name="vlan" value="<?= $data_aktivasi['vlan'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">MAC Address</label>
                                        <input type="text" class="form-control" name="macAddress" value="<?= $data_aktivasi['macAddress'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Serial Number</label>
                                        <input type="text" class="form-control" name="serialNumber" value="<?= $data_aktivasi['serialNumber'] ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Jenis IP</label>
                                        <select name="jenisIp" id="" class="form-select" required>
                                            <option value="">-- Pilih Jenis IP --</option>
                                            <option value="1" <?= $data_aktivasi['jenisIp'] == 1 ? "selected" : "" ?>>IP Publik</option>
                                            <option value="2" <?= $data_aktivasi['jenisIp'] == 2 ? "selected" : "" ?>>IP Private</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Aktif -->
                        <h5 class="mt-3">Start Billing</h5>
                        <div class="card-body border border-1 rounded">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tanggal Aktif</label>
                                        <input type="date" class="form-control" name="tanggalPembayaran" value="<?= $data_aktif['tanggalPembayaran'] ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Total Pembayaran</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" class="form-control number" name="jumlahPembayaran" value="<?= $data_aktif['jumlahPembayaran'] ?>">
                                        </div>
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

            </div>
            <div class="card-footer">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
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

        // hitung ppn biaya registrasi
        var biayaregistrasiPPN = 0;
        $('.ppnbiayainstalasi').on('change', function() {
            var biayaregistrasi = parseInt($('.biayaregistrasiLayanan').val().replace(".", ""));
            var biayaregistrasiPPNAkhir = 0;
            if ($(this).val() == '1') {
                biayaregistrasiPPN = (biayaregistrasi * 10) / 100;
                biayaregistrasiPPNAkhir = biayaregistrasi + biayaregistrasiPPN;
            } else {
                biayaregistrasiPPNAkhir = biayaregistrasi - biayaregistrasiPPN;
                biayaregistrasiPPN = 0;
            }
            $('.biayaregistrasiLayanan').val(
                biayaregistrasiPPNAkhir.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            );
        })

        // hitung ppn biaya bulanan
        var biayabulananPPN = 0;
        $('.ppnbiayabulanan').on('change', function() {
            var biayabulanan = parseInt($('.biayabulananLayanan').val().replace(".", ""));
            var biayabulananPPNAkhir = 0;
            if ($(this).val() == '1') {
                biayabulananPPN = (biayabulanan * 10) / 100;
                biayabulananPPNAkhir = biayabulanan + biayabulananPPN;
            } else {
                biayabulananPPNAkhir = biayabulanan - biayabulananPPN;
                biayabulananPPN = 0;
            }
            $('.biayabulananLayanan').val(
                biayabulananPPNAkhir.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            );
        })

        // copy data user ke pic keuangan
        $('#cekKeuangan').on('click', function() {
            var isChecked = $(this).is(':checked');
            if (isChecked) {
                $('.nikPicKeuangan').val($('.nikUserRegistrasi').val())
                $('.namaPicKeuangan').val($('.namauserRegistrasi').val())
                $('.noTelpPICKeuangan').val($('.telpkontakuser').val())
                $('.noWaPICKeuangan').val($('.whatsappkontakuser').val())
                $('.emailPICKeuangan').val($('.emailkontakuser').val())
            }
        })

        // copy data user ke pic teknis
        $('#cekTeknis').on('click', function() {
            var isChecked = $(this).is(':checked');
            if (isChecked) {
                $('.nikPicTeknik').val($('.nikUserRegistrasi').val())
                $('.namaPicTeknik').val($('.namauserRegistrasi').val())
                $('.noTelpPICTeknik').val($('.telpkontakuser').val())
                $('.noWaPICTeknik').val($('.whatsappkontakuser').val())
                $('.emailPICTeknik').val($('.emailkontakuser').val())
            }
        })
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