<?php

namespace App\MinatStatus\Model;

use Core\GlobalFunc;
use PDOException;

class MinatStatus extends GlobalFunc
{
    private $table = 'minat';
    private $primaryKey = 'idMinat';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet  = minatlayanan.idLayanan " . $where;

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

    public function selectOne($id)
    {
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan FROM " . $this->table .  " LEFT JOIN provinsi ON provinsi.id = minat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = minat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = minat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = minat.idKelurahan LEFT JOIN sales ON sales.nikSales = minat.idSales LEFT JOIN media ON  media.idRelation = minat.kodeMinat  WHERE kodeMinat = '$id'";

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
}
