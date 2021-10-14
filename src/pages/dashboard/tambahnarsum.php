<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Nama</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/iconly/bold.css">

  <link rel="stylesheet" href="/assets/css/perfect-scrollbar.css">
  <link rel="stylesheet" href="/assets/css/bootstrapicons/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/app.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="/assets/css/bs5datepicker.css">
</head>

<body id="main2">

  <nav class="navbar navbar-light">
    <div class="container d-block">
      <a href="index.html"><i class="bi bi-chevron-left"></i></a>
      <a class="navbar-brand ms-4" href="index.html">
        <img src="/assets/media/logosimbadak-02.png" class="w-25">
      </a>
    </div>
  </nav>


  <div class="container">
    <div class="card mt-5">
      <div class="card-header">
        <h4 class="card-title">Tambah Data Nama</h4>
      </div>
      <div class="card-body">
        <form class="row g-3 pt-3">
          <div class="col-md-6">
            <label for="nama" class="form-label">Nama (Tanpa Gelar)</label>
            <input type="text" class="form-control" id="nama">
          </div>
          <div class="col-md-6">
            <label for="namalengkap" class="form-label">Nama Lengkap (Dengan Gelar)</label>
            <input type="text" class="form-control" id="namalengkap">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label ">Tanggal Lahir</label>
            <input type="text" class="form-control dateselect" id="inputAddress" placeholder="Bulan/Tanggal/Tahun">
          </div>
          <div class="col-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sudahwafat">
              <label class="form-check-label" for="sudahwafat">
                Sudah Wafat ?
              </label>
            </div>
          </div>
          <div class="col-3 invisible" id="tanggalwafat">
            <label for="wafat" class="form-label ">Tanggal Wafat</label>
            <input type="text" class="form-control dateselect2 " placeholder="Bulan/Tanggal/Tahun">
          </div>
          <div class="col-3 invisible" id="longitudewafat">
            <label class="form-label ">Lokasi Makam</label>
            <input type="text" class="form-control " placeholder="Longitude">
          </div>
          <div class="col-3 invisible" id="latitudewafat">
            <label class="form-label invisible">Lokasi Makam</label>
            <input type="text" class="form-control " placeholder="Latitude">
          </div>
          <div class="col-md-12">
            <h6>Alamat Tinggal</h6>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="inputCity" class="form-label">Provinsi</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="inputState" class="form-label">Kabupaten</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="inputZip" class="form-label">Kecamatan</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-md-3 col-sm-12">
            <label for="inputZip" class="form-label">Kelurahan</label>
            <select id="inputState" class="form-select">
              <option selected>Choose...</option>
              <option>...</option>
            </select>
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Check me out
              </label>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
          </div>
        </form>
      </div>
    </div>
  </div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/js/datanama.js"></script>

</html>