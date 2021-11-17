<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBADAK</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/iconly/bold.css">

    <link rel="stylesheet" href="/assets/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/css/bootstrapicons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
    <div id="app">
        <?php include('../src/pages/adminhelper/sidebar.php'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Data Pelaporan Kegiatan</h3>
            </div>
            <div class="page-content">
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tambah Data</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="/penelitian-kegiatan/store" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Nama Pelaporan</label>
                                                        <input type="text" id="first-name-column" class="form-control" placeholder="Nama Pelaporan" name="namaKegiatan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Abstrak</label>
                                                        <input type="text" id="last-name-column" class="form-control" placeholder="Asbtrak" name="abstrakKegiatan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Nomor Surat</label>
                                                        <input type="text" id="city-column" class="form-control" placeholder="Nomor Surat" name="nomorsuratKegiatan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Lokasi</label>
                                                        <input type="text" id="country-floating" class="form-control" name="country-floating" placeholder="Lokasi">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">OPK</label>
                                                        <select name="opk[]" id="example" class="form-control multi-select" multiple="multiple" style="display: none;">
                                                            <?php foreach ($opk as $key => $value) { ?>
                                                                <option value="<?= $value["idOpk"] ?>"><?= $value["namaOpk"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Subyek</label>
                                                        <select name="subyek[]" id="example" class="form-control multi-select" multiple="multiple" style="display: none;">
                                                            <?php foreach ($subyek as $key => $value) { ?>
                                                                <option value="<?= $value["idSubyek"] ?>"><?= $value["namaSubyek"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Nama Ketua</label>
                                                        <select name="ketua" id="example" class="form-control">
                                                            <option value=""> -- Pilih Nama Ketua -- </option>
                                                            <?php foreach ($penelitianNarsum as $key => $value) { ?>
                                                                <option value="<?= $value["idPenelitiannarsum"] ?>"><?= $value["namaNarsum"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Nama Anggota</label>
                                                        <select name="anggota[]" id="example" class="form-control multi-select" multiple="multiple" style="display: none;">
                                                            <?php foreach ($penelitianNarsum as $key => $value) { ?>
                                                                <option value="<?= $value["idPenelitiannarsum"] ?>"><?= $value["namaNarsum"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Jenis Dokumen Laporan</label>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_dokumen_laporan" value="1" class="jenis_dokumen_laporan"> Laporan Kajian
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_dokumen_laporan_file1" class="jenis_dokumen_laporan1" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_dokumen_laporan" value="2" class="jenis_dokumen_laporan"> Laporan Inventarisasi
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_dokumen_laporan_file2" class="jenis_dokumen_laporan2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_dokumen_laporan" value="3" class="jenis_dokumen_laporan"> Laporan Perekaman
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_dokumen_laporan_file3" class="jenis_dokumen_laporan3" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_dokumen_laporan" value="4" class="jenis_dokumen_laporan"> Laporan Internalisasi
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_dokumen_laporan_file4" class="jenis_dokumen_laporan4" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_dokumen_laporan" value="5" class="jenis_dokumen_laporan"> Laporan Undangan (Resume)
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_dokumen_laporan_file5" class="jenis_dokumen_laporan5" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Jenis Video Pelaporan</label>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_video_pelaporan" value="1" class="jenis_video_pelaporan"> Video Perekaman
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_video_pelaporan_file1" class="jenis_video_pelaporan1" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_video_pelaporan" value="2" class="jenis_video_pelaporan"> Video Liputan
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_video_pelaporan_file2" class="jenis_video_pelaporan2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_video_pelaporan" value="3" class="jenis_video_pelaporan"> Video Daring
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_video_pelaporan_file3" class="jenis_video_pelaporan3" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_video_pelaporan" value="4" class="jenis_video_pelaporan"> Video Komunitas
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_video_pelaporan_file4" class="jenis_video_pelaporan4" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Jenis Foto Pelaporan</label>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_foto_pelaporan" value="1" class="jenis_foto_pelaporan"> Laporan Kajian
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_foto_pelaporan_file1" class="jenis_foto_pelaporan1" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_foto_pelaporan" value="2" class="jenis_foto_pelaporan"> Laporan Inventarisasi
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_foto_pelaporan_file2" class="jenis_foto_pelaporan2" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_foto_pelaporan" value="3" class="jenis_foto_pelaporan"> Laporan Perekaman
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_foto_pelaporan_file3" class="jenis_foto_pelaporan3" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_foto_pelaporan" value="4" class="jenis_foto_pelaporan"> Laporan Internalisasi
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_foto_pelaporan_file4" class="jenis_foto_pelaporan4" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="radio" name="jenis_foto_pelaporan" value="5" class="jenis_foto_pelaporan"> Laporan Undangan (Resume)
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="file" name="jenis_foto_pelaporan_file5" class="jenis_foto_pelaporan5" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                 
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

            <?php include('../src/pages/adminhelper/footer.php'); ?>
        </div>
    </div>

    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/pages/dashboard.js"></script>

    <script src="/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="/assets/js/BsMultiSelect.min.js"></script>
    <script src="/assets/js/admin/penelitian-kegiatan.js"></script>

    <script>
        $(document).ready(function() {
            $(".multi-select").bsMultiSelect();
        })
    </script>
</body>

</html>