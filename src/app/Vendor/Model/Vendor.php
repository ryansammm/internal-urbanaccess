<?php

namespace App\Vendor\Model;

use Core\GlobalFunc;

class Vendor extends GlobalFunc
{
    private $table = 'vendor';
    private $primaryKey = 'idVendor';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN vendoralamat ON vendoralamat.idVendor = " . $this->table . "." . $this->primaryKey . " " . $where;
        // dd($sql);

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
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan  FROM " . $this->table . " LEFT JOIN vendoralamat ON vendoralamat.idVendor = vendor.idVendor LEFT JOIN provinsi ON provinsi.id = vendoralamat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = vendoralamat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = vendoralamat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = vendoralamat.idKelurahan LEFT JOIN media ON media.idRelation = vendor.idVendor LEFT JOIN grouppic ON grouppic.idRelation = vendor.idVendor LEFT JOIN pic ON pic.nikPic = grouppic.nikPic WHERE vendor.idVendor = '$id'";
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

        $idVendor = uniqid('idVendor');
        $kodeVendor = $datas['kodeVendor'];
        $namaVendor = $datas['namaVendor'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');


        $sql = "INSERT INTO " . $this->table . " VALUES ('$idVendor','$namaVendor', '$kodeVendor', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idVendor;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $kodeVendor = $datas['kodeVendor'];
        $namaVendor = $datas['namaVendor'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET namaVendor='$namaVendor', kodeVendor='$kodeVendor', updatedAt='$updatedAt' WHERE idVendor='$id'";

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
        $sql = "DELETE FROM " . $this->table . " WHERE idVendor ='$id'";
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
