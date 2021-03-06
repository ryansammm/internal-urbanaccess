<?php

namespace App\RegistrasiUser\Model;

use Core\GlobalFunc;
use PDOException;

class InternetUserRegistrasi extends GlobalFunc
{
    private $table = 'internetuserregistrasi';
    private $primaryKey = 'noRegistrasi';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan FROM " . $this->table . " LEFT JOIN internetuserlayanan ON internetuserlayanan.idInternetuserregistrasi  = internetuserregistrasi.noRegistrasi LEFT JOIN layananinternet ON layananinternet.idLayananinternet = internetuserlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternetdetail = internetuserlayanan.idLayanandetail LEFT JOIN salesperorangan ON salesperorangan.idSales = internetuserregistrasi.idSales LEFT JOIN salesreseller ON salesreseller.idSales = internetuserregistrasi.idSales LEFT JOIN internetuseralamat ON internetuseralamat.noRegistrasi = internetuserregistrasi.noRegistrasi LEFT JOIN provinsi ON provinsi.id = internetuseralamat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = internetuseralamat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = internetuseralamat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = internetuseralamat.idKelurahan " . $where;

        // dd($sql);

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectAllJoin($where = "")
    {
        $sql = "SELECT *, internetuserregistrasi.noRegistrasi AS nomorRegistrasi, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan FROM " . $this->table . " LEFT JOIN internetuserlayanan ON internetuserlayanan.idInternetuserregistrasi  = internetuserregistrasi.noRegistrasi LEFT JOIN layananinternet ON layananinternet.idLayananinternet = internetuserlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternetdetail = internetuserlayanan.idLayanandetail LEFT JOIN salesperorangan ON salesperorangan.idSales = internetuserregistrasi.idSales LEFT JOIN salesreseller ON salesreseller.idSales = internetuserregistrasi.idSales LEFT JOIN internetuseralamat ON internetuseralamat.noRegistrasi = internetuserregistrasi.noRegistrasi LEFT JOIN provinsi ON provinsi.id = internetuseralamat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = internetuseralamat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = internetuseralamat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = internetuseralamat.idKelurahan " . $where;

        // dd($sql);

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($datas)
    {
        $noRegistrasi = $datas['noRegistrasi'];
        $kodeformInternetregistrasi = $datas['kodeformInternetregistrasi'];
        $tanggalRegistrasi = $datas['tanggalRegistrasi'];
        $idSales = $datas['idSales'];
        $nikUserRegistrasi = $datas['nikUserRegistrasi'];
        $idUser = $datas['idUser'];
        $jenisuserRegistrasi = $datas['jenisuserRegistrasi'];
        $statusRegistrasi =  isset($datas['statusRegistrasi']) ? $datas['statusRegistrasi'] : NULL;
        $namauserRegistrasi = $datas['namauserRegistrasi'];
        $jabatanuserRegistrasi =  isset($datas['jabatanuserRegistrasi']) ? $datas['jabatanuserRegistrasi'] : NULL;
        $namabadanRegistrasi =  isset($datas['namabadanRegistrasi']) ? $datas['namabadanRegistrasi'] : NULL;
        $jenisusahaRegistrasi =  isset($datas['jenisusahaRegistrasi']) ? $datas['jenisusahaRegistrasi'] : NULL;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        $keterangan = $datas['keterangan'];
        $nikPicKeuangan = $datas['nikPicKeuangan'];
        $nikPicTeknis = $datas['nikPicTeknis'];

        $sql = "INSERT INTO " . $this->table . " VALUES ('$noRegistrasi','$kodeformInternetregistrasi', '$tanggalRegistrasi', '$idSales', '$nikUserRegistrasi', '$idUser', '$jenisuserRegistrasi', '$statusRegistrasi', '$namauserRegistrasi', '$jabatanuserRegistrasi', '$namabadanRegistrasi', '$jenisusahaRegistrasi', '$createdAt', '$updatedAt','$keterangan','$nikPicKeuangan','$nikPicTeknis')";
        // dd($sql);
        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $noRegistrasi;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN salesperorangan ON salesperorangan.idSales = internetuserregistrasi.idSales LEFT JOIN salesreseller ON salesreseller.idSales = internetuserregistrasi.idSales WHERE internetuserregistrasi." . $this->primaryKey . " = '$id'";
        // dd($sql);

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOneWHere($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $kodeformInternetregistrasi =  isset($datas['kodeformInternetregistrasi']) ? $datas['kodeformInternetregistrasi'] : NULL;
        $tanggalRegistrasi =  isset($datas['tanggalRegistrasi']) ? $datas['tanggalRegistrasi'] : NULL;
        $idSales =  isset($datas['idSales']) ? $datas['idSales'] : NULL;
        $nikUserRegistrasi = isset($datas['nikUserRegistrasi']) ? $datas['nikUserRegistrasi'] : NULL;
        $idUser =  isset($datas['idUser']) ? $datas['idUser'] : NULL;
        $jenisuserRegistrasi =  isset($datas['jenisuserRegistrasi']) ? $datas['jenisuserRegistrasi'] : NULL;
        $namauserRegistrasi =  isset($datas['namauserRegistrasi']) ? $datas['namauserRegistrasi'] : NULL;
        $jabatanuserRegistrasi =  isset($datas['jabatanuserRegistrasi']) ? $datas['jabatanuserRegistrasi'] : NULL;
        $namabadanRegistrasi =  isset($datas['namabadanRegistrasi']) ? $datas['namabadanRegistrasi'] : NULL;
        $jenisusahaRegistrasi =  isset($datas['jenisusahaRegistrasi']) ? $datas['jenisusahaRegistrasi'] : NULL;
        $updatedAt = date('Y-m-d H:i:s');
        $keterangan = $datas['keterangan'];
        $nikPicKeuangan = $datas['nikPicKeuangan'];
        $nikPicTeknis = $datas['nikPicTeknis'];

        $sql = "UPDATE " . $this->table . " SET kodeformInternetregistrasi = '$kodeformInternetregistrasi', tanggalRegistrasi = '$tanggalRegistrasi', idSales = '$idSales', nikUserRegistrasi = '$nikUserRegistrasi', idUser = '$idUser', jenisuserRegistrasi = '$jenisuserRegistrasi', namauserRegistrasi = '$namauserRegistrasi', jabatanuserRegistrasi = '$jabatanuserRegistrasi', namabadanRegistrasi = '$namabadanRegistrasi', jenisusahaRegistrasi = '$jenisusahaRegistrasi', updatedAt = '$updatedAt', keterangan ='$keterangan', nikPicKeuangan = '$nikPicKeuangan', nikPicTeknis = '$nikPicTeknis' WHERE " . $this->primaryKey . " = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function kodeformInternetregistrasi($kodeformInternetregistrasi)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE kodeformInternetregistrasi='$kodeformInternetregistrasi' ";
        // dd($sql);


        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            return $data;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }


    public function jenisuserRegistrasi($jenisuserRegistrasi)
    {

        $jenis = '';

        if ($jenisuserRegistrasi = "Perorangan") {
            $jenis = '1';
        } elseif ($jenisuserRegistrasi = "Instansi Swasta / Korporasi") {
            $jenis = '2';
        } else {
            $jenis = '3';
        }

        return $jenis;
    }

    public function status($id, $statusRegistrasi)
    {

        $sql = "UPDATE " . $this->table . " SET statusRegistrasi = '$statusRegistrasi' WHERE noRegistrasi  = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }


    public function statusRegistrasi($id, $status)
    {

        $sql = "UPDATE " . $this->table . " SET statusRegistrasi = '$status' WHERE " . $this->primaryKey . " = '$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }
}
