<?php

namespace App\MinatLayanan\Model;

use App\LayananInternet\Model\LayananInternet;
use Core\GlobalFunc;
use PDOException;

class MinatLayanan extends GlobalFunc
{
    private $table = 'minatlayanan';
    private $primaryKey = 'idMinatlayanan';
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

        $idMinatLayanan = uniqid('mln');
        $idMinat = $datas['idMinat'];
        $idLayanan = $datas['idLayanan'];
        $idLayanandetail = $datas['idLayanandetail'];
        $biayaregistrasiLayanan = $datas['biayaregistrasiLayanan'];
        $biayabulananLayanan = $datas['biayabulananLayanan'];
        $biayadasarregistrasiLayanan = $datas['biayadasarregistrasiLayanan'];
        $biayadasarbulananLayanan = $datas['biayadasarbulananLayanan'];
        $ppnbiayaregistrasiLayanan = $datas['ppnbiayaregistrasiLayanan'];
        $ppnbiayabulananLayanan = $datas['ppnbiayabulananLayanan'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idMinatLayanan', '$idMinat', '$idLayanan', '$idLayanandetail', '$biayaregistrasiLayanan', '$biayabulananLayanan', '$biayadasarregistrasiLayanan', '$biayadasarbulananLayanan', '$ppnbiayaregistrasiLayanan', '$ppnbiayabulananLayanan', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idMinatLayanan;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternetdetail  = minatlayanan.idLayanandetail  " . $where;
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

    public function update($id, $datas)
    {
        $idMinat = $datas['idMinat'];
        $idLayanan = $datas['idLayanan'];
        $idLayanandetail = $datas['idLayanandetail'];
        $biayaregistrasiLayanan = $datas['biayaregistrasiLayanan'];
        $biayabulananLayanan = $datas['biayabulananLayanan'];
        $biayadasarregistrasiLayanan = $datas['biayadasarregistrasiLayanan'];
        $biayadasarbulananLayanan = $datas['biayadasarbulananLayanan'];
        $ppnbiayaregistrasiLayanan = $datas['ppnbiayaregistrasiLayanan'];
        $ppnbiayabulananLayanan = $datas['ppnbiayabulananLayanan'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idLayanan = '$idLayanan', idMinat = '$idMinat', idLayanandetail = '$idLayanandetail', biayaregistrasiLayanan = '$biayaregistrasiLayanan', biayabulananLayanan = '$biayabulananLayanan', biayadasarregistrasiLayanan = '$biayadasarregistrasiLayanan', biayadasarbulananLayanan = '$biayadasarbulananLayanan', ppnbiayaregistrasiLayanan = '$ppnbiayaregistrasiLayanan', ppnbiayabulananLayanan = '$ppnbiayabulananLayanan', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

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
        $sql = "DELETE FROM " . $this->table . " WHERE idMinat = '$id'";
        // dd($sql);

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();

            return $query;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }
}
