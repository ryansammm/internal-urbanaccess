<?php

namespace App\LayananInternetDetail\Model;

use Core\GlobalFunc;
use PDOException;

class LayananInternetDetail extends GlobalFunc
{
    private $table = 'layananinternetdetail';
    private $primaryKey = 'idLayananinternetdetail';
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

    public function selectOne($where = "")
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

    public function create($datas)
    {
        $id = uniqid('idLayananinternetdetail');
        $idLayananinternet = $datas->get('idLayananinternet');
        $kecepatan = $datas->get('kecepatan');
        $biayaregistrasi = $datas->get('biayaregistrasi');
        $biayadasarbulanan = $datas->get('biayadasarbulanan');
        $biayabulanan = $datas->get('biayabulanan');
        $ppn = $datas->get('ppn');
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$idLayananinternet','$kecepatan','$biayaregistrasi','$biayadasarbulanan = $datas->get('biayadasarbulanan');
        ','$biayabulanan','$ppn','$createdAt','$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $kecepatan = $datas->get('kecepatan');
        $biayaregistrasi = $datas->get('biayaregistrasi');
        $biayadasarbulanan = $datas->get('biayadasarbulanan');
        $biayabulanan = $datas->get('biayabulanan');
        $ppn = $datas->get('ppn');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET kecepatan = '$kecepatan', biayaregistrasi = '$biayaregistrasi', biayadasarbulanan = '$biayadasarbulanan', biayabulanan = '$biayabulanan', ppn = '$ppn', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }



    public function idLayananinternet($idLayananinternet, $kecepatan)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idLayananinternet='$idLayananinternet' AND kecepatan='$kecepatan' ";

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
