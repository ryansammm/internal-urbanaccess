<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./">Kembali</a>
    <?php include(__DIR__.'/../../components/menu.php'); ?>
    <h2>Detail Penelitian Kegiatan : <?= $detail['idPenelitiankegiatan'] ?></h2>

    Nama Kegiatan : <?= $detail['namaKegiatan'] ?> <br>
    Tanggal Surat Kegiatan : <?= $detail['tanggalsuratKegiatan'] ?> <br>
    Wilayah : <?= $detail['provinsi']['namaProvinsi'] ?>, <?= $detail['kabupaten']['namaKabupaten'] ?>, <?= $detail['kecamatan']['namaKecamatan'] ?>, <?= $detail['kelurahan']['namaKelurahan'] ?> <br>
    Jenis Penelitian : <?= $detail['jenisPenelitian']['namaJenispenelitian'] ?> <br>
    Group OPK : 
    <table border="1">
        <tr>
            <td>Nama OPK</td>
            <td>Definisi OPK</td>
        </tr>
        <?php foreach ($detail['groupOpk'] as $key => $value) { ?>
            <tr>
                <td><?= $value['namaOpk'] ?></td>
                <td><?= $value['definisiOpk'] ?></td>
            </tr>
        <?php } ?>
    </table> <br>
    Group Subyek : 
    <table border="1">
        <tr>
            <td>Nama Subyek</td>
            <td>Definisi Subyek</td>
        </tr>
        <?php foreach ($detail['groupSubyek'] as $key => $value) { ?>
            <tr>
                <td><?= $value['namaSubyek'] ?></td>
                <td><?= $value['definisiSubyek'] ?></td>
            </tr>
        <?php } ?>
    </table> <br>
    Group Peneliti : 
    <table border="1">
        <tr>
            <td>Nama Pegawai</td>
            <td>Jabatan Group Peneliti</td>
        </tr>
        <?php foreach ($detail['groupPeneliti'] as $key => $value) { ?>
            <tr>
                <td><?= $value['namaPegawai'] ?></td>
                <td><?= $value['namaHirarki'] ?></td>
            </tr>
        <?php } ?>
    </table> <br>
</body>
</html>