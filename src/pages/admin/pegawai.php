<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/Login/logincss.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/css/sidebar/styles.css">
  <title>BPNB</title>
</head>

<body>

  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading text-center fw-bold bg-white mt-2">
        <h2>DASHBOARD</h2>
      </div>
      <hr class="line1 text-secondary">
      <div class="list list-group">

        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-user"></i>Data Nama</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-users"></i>Data Komunitas</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-paste"></i>Data Pelaporan<br>Kegiatan</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-print"></i>Data Cetak</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-theater-masks"></i>Data WBTB</a>
        <hr class="line2 text-secondary mb-3">
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-book"></i>Data OPK</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-align-left"></i>Data Subyek</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-photo-video"></i>Media Library</a>
        <hr class="line2 text-secondary mb-3">
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-user-cog"></i>User Management</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="far fa-address-card"></i>Pegawai Management</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-external-link-alt"></i>Eksternal Management</a>
        <a class="list-group-item-light mb-1" href="#!"><i class="fas fa-user-tie"></i>Pendataan Guest</a>


      </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
      <!-- Top navigation-->
      <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="height: 80px;">
        <div class="container-fluid">
          <button class="btn" id="sidebarToggle">Toggle Menu</button>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#!">Action</a>
                  <a class="dropdown-item" href="#!">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#!">Something else here</a>
                </div>
              </li>
            </ul>
          </div>

          <div class="container">
    <fieldset>
      <form class="form-horizontal bg-light shadow mt-5">
        <h1>Data Nama</h1>
        <hr>
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td>Nama (Tanpa Gelar)</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Nama Lengkap (Dengan Gelar)</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Tanggal Lahir</td>
              <td>
                <input type="date" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Tempat Lahir</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Wafat
                <hr>
              </td>
            </tr>
            <tr>
              <td class="mt-5">Tanggal Wafat</td>
              <td>
                <input type="date" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Lokasi Makam</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Alamat
                <hr>
              </td>
            </tr>
            <tr>
              <td>Jalan</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Desa/Kelurahan</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Kecamatan</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Kabupaten</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Kota</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Provinsi</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Nomor Kontak</td>
              <td>
                <input type="number" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Email</td>
              <td>
                <input type="email" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Foto Potrait</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple">
              </td>
            </tr>
            <tr>
              <td>Jenis Pekerjaan</td>
              <td>
                <div class="row">
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Sanggar</label>
                  </div>
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Dinas</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Komunitas</label>
                  </div>
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Perguruan Tinggi</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Lembaga</label>
                  </div>
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Badan</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Balai</label>
                  </div>
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Penggiat Budaya</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 ">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Wiraswasta</label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>Nama Pekerjaan</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Tokoh</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>NIP/NIK</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>NIP/NIK</td>
              <td>
                <input type="number" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Riwayat Pangkat</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </td>
            </tr>
            <tr>
              <td>Riwayat Jabatan</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </td>
            </tr>
            <tr>
              <td>Riwayat Pendidikan</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </td>
            </tr>
            <tr>
              <td>Riwayat Pekerjaan</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </td>
            </tr>
            <tr>
              <td>Riwayat Penghargaan</td>
              <td>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
              </td>
            </tr>
            <tr>
              <td>Keahlian</td>
              <td>
                <input type="text" class="form-control bg-secondary">
              </td>
            </tr>
            <tr>
              <td>Spesifikasi Keahlian</td>
              <td>
                <div class="row">
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Budayawan</label>
                  </div>
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Sejarawan</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Pelaku Sejarah</label>
                  </div>
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Pelaku Budaya</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckDefault">
                    <label for="flexCheckDefault">Pemerhati Sejarah</label>
                  </div>
                  <div class="col-6">
                    <input type="checkbox" value="" id="flexCheckChecked">
                    <label for="flexCheckChecked">Pemerhati Budaya</label>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <button type="button" class="btn btn-success float-end">Success</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </fieldset>
  </div>
        </div>
      </nav>
    </div>
  </div>










  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="assets/js/scripts.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>