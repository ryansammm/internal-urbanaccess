<?php

namespace App\RegistrasiUserMinat\Model;

use Core\GlobalFunc;
use PDOException;

class InternetUserRegistrasiMinat extends GlobalFunc
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
        $sql = "SELECT * FROM " . $this->table . " " . $where;

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
        $statusRegistrasi = NULL;
        $namauserRegistrasi = $datas['namauserRegistrasi'];
        $jabatanuserRegistrasi = NULL;
        $namabadanRegistrasi = NULL;
        $jenisusahaRegistrasi = NULL;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        $keterangan = $datas['keterangan'];
        $nikPicKeuangan = $datas['nikPicKeuangan'];
        $nikPicTeknis = $datas['nikPicTeknis'];

        $sql = "INSERT INTO " . $this->table . " VALUES ('$noRegistrasi','$kodeformInternetregistrasi', '$tanggalRegistrasi', '$idSales', '$nikUserRegistrasi', '$idUser', '$jenisuserRegistrasi', '$statusRegistrasi', '$namauserRegistrasi', '$jabatanuserRegistrasi', '$namabadanRegistrasi', '$jenisusahaRegistrasi', '$createdAt', '$updatedAt', '$keterangan','$nikPicKeuangan','$nikPicTeknis')";
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
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

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
        $kodeformInternetregistrasi = $datas['kodeformInternetregistrasi'];
        $tanggalRegistrasi = $datas['tanggalRegistrasi'];
        $idSales = $datas['idSales'];
        $idMitra = $datas['idMitra'];
        $idUser = $datas['idUser'];
        $jenisuserRegistrasi = $datas['jenisuserRegistrasi'];
        $statusRegistrasi = $datas['statusRegistrasi'];
        $namauserRegistrasi = $datas['namauserRegistrasi'];
        $jabatanuserRegistrasi = $datas['jabatanuserRegistrasi'];
        $namabadanRegistrasi = $datas['namabadanRegistrasi'];
        $jenisusahaRegistrasi = $datas['jenisusahaRegistrasi'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET kodeformInternetregistrasi = '$kodeformInternetregistrasi', tanggalRegistrasi = '$tanggalRegistrasi', idSales = '$idSales', idMitra = '$idMitra', idUser = '$idUser', jenisuserRegistrasi = '$jenisuserRegistrasi', statusRegistrasi = '$statusRegistrasi', namauserRegistrasi = '$namauserRegistrasi', jabatanuserRegistrasi = '$jabatanuserRegistrasi', namabadanRegistrasi = '$namabadanRegistrasi', jenisusahaRegistrasi = '$jenisusahaRegistrasi', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

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
}
