<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .text-elps-3 {
            -webkit-line-clamp: 3 !important;
        }

        .text-elps {
            display: -webkit-box !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
    </style>
</head>
<body>
    <?php include(__DIR__.'/../../components/menu.php'); ?>
    <h2>Penelitian Kegiatan</h2>
    
    <table border="1">
        <tr>
            <td>No</td>
            <td>Nama Kegiatan</td>
            <td>Tanggal Surat Kegiatan</td>
            <td>Aksi</td>
        </tr>
        <?php foreach ($penelitianKegiatan as $key => $value) { ?>
            <tr>
                <td><?= $key+=1 ?></td>
                <td><?= $value['namaKegiatan'] ?></td>
                <td><?= $value['tanggalsuratKegiatan'] ?></td>
                <td>
                    <a href="penelitian-kegiatan/<?= $value['idPenelitiankegiatan'] ?>">Detail</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>