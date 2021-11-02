<?php

namespace App\VendorAlamat\Model;

use Core\GlobalFunc;

class VendorAlamat extends GlobalFunc
{
    private $table = 'vendoralamat';
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
        } catch (\PDOException $e) {
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
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($idVendor, $datas)
    {
        $alamatVendor = $datas['alamatVendor'];
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodeposVendor = $datas['kodeposVendor'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idVendor','$alamatVendor', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$kodeposVendor', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idVendor;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($idVendor, $datas)
    {
        $alamatVendor = $datas['alamatVendor'];
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodeposVendor = $datas['kodeposVendor'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET alamatVendor='$alamatVendor', idProvinsi='$idProvinsi', idKabupaten='$idKabupaten', idKecamatan='$idKecamatan', idKelurahan='$idKelurahan', kodeposVendor='$kodeposVendor', updatedAt='$updatedAt' WHERE idVendor='$idVendor'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idVendor;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idVendor = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (\PDOException $e) {
            dump($e);
            die();
        }
    }
}
