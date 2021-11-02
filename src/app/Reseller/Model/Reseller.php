<?php

namespace App\Reseller\Model;

use Core\GlobalFunc;

class Reseller extends GlobalFunc
{
    private $table = 'salesreseller';
    private $primaryKey = 'idSales';
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
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan FROM " . $this->table . " LEFT JOIN salesalamat ON salesalamat.idSales = salesreseller.idSales LEFT JOIN provinsi ON provinsi.id = salesalamat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = salesalamat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = salesalamat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = salesalamat.idKelurahan LEFT JOIN grouppic ON grouppic.idRelation = salesreseller.idSales LEFT JOIN pic ON pic.nikPic = grouppic.nikPic WHERE salesreseller." . $this->primaryKey . " = '$id'";
        // dd($sql);

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

    public function create($datas)
    {
        $idSales = uniqid('idSales');
        $nikSales = $datas['nikSales'];
        $namaSales = $datas['namaSales'];
        $singkatanSales = $datas['singkatanSales'];
        $tanggalbergabungSales = $datas['tanggalbergabungSales'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idSales', '$nikSales', '$namaSales', '$singkatanSales', '$tanggalbergabungSales', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idSales;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $nikSales = $datas['nikSales'];
        $namaSales = $datas['namaSales'];
        $singkatanSales = $datas['singkatanSales'];
        $tanggalbergabungSales = $datas['tanggalbergabungSales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET nikSales='$nikSales', namaSales='$namaSales', singkatanSales='$singkatanSales', tanggalbergabungSales='$tanggalbergabungSales', updatedAt='$updatedAt' WHERE idSales = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";
        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }
}
