<?php

namespace App\InternetUserLayanan\Model;

use Core\GlobalFunc;
use PDOException;

class InternetUserLayanan extends GlobalFunc
{
    private $table = 'internetuserlayanan';
    private $primaryKey = 'idInternetuserregistrasi';
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

    public function create($idInternetuserregistrasi, $datas)
    {
        $idLayanan = $datas['idLayanan'];
        $idLayanandetail = $datas['idLayanandetail'];
        $biayaregistrasiLayanan = $datas['biayaregistrasiLayanan'];
        $biayabulananLayanan = $datas['biayabulananLayanan'];
        $biayadasarregistrasiLayanan = $datas['biayadasarregistrasiLayanan'];
        $biayadasarbulananLayanan = $datas['biayadasarbulananLayanan'];
        $ppnbiayaregistrasi = $datas['ppnbiayaregistrasi'];
        $ppnbiayabulanan = $datas['ppnbiayabulanan'];
        $statusLayanan = $datas['statusLayanan'];
        $mediakoneksiLayanan = $datas['mediakoneksiLayanan'];
        $ippublicLayanan = $datas['ippublicLayanan'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idInternetuserregistrasi','$idLayanan', '$idLayanandetail', '$biayaregistrasiLayanan', '$biayabulananLayanan', '$biayadasarregistrasiLayanan', '$biayadasarbulananLayanan', '$ppnbiayaregistrasi', '$ppnbiayabulanan', '$statusLayanan', '$mediakoneksiLayanan', '$ippublicLayanan', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idInternetuserregistrasi;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN layananinternet ON layananinternet.idLayananinternet = internetuserlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternet = internetuserlayanan.idLayanandetail WHERE " . $this->primaryKey . " = '$id'";
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

    public function selectOneWhere($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN layananinternet ON layananinternet.idLayananinternet = internetuserlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternetdetail = internetuserlayanan.idLayanandetail " . $where;
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
        $idLayanan =  isset($datas['idLayanan']) ? $datas['idLayanan'] : NULL;
        $idLayanandetail =  isset($datas['idLayanandetail']) ? $datas['idLayanandetail'] : NULL;
        $biayaregistrasiLayanan =  isset($datas['biayaregistrasiLayanan']) ? $datas['biayaregistrasiLayanan'] : NULL;
        $biayabulananLayanan =  isset($datas['biayabulananLayanan']) ? $datas['biayabulananLayanan'] : NULL;
        $biayadasarregistrasiLayanan =  isset($datas['biayadasarregistrasiLayanan']) ? $datas['biayadasarregistrasiLayanan'] : NULL;
        $biayadasarbulananLayanan =  isset($datas['biayadasarbulananLayanan']) ? $datas['biayadasarbulananLayanan'] : NULL;
        $ppnbiayaregistrasi =  isset($datas['ppnbiayaregistrasi']) ? $datas['ppnbiayaregistrasi'] : NULL;
        $ppnbiayabulanan =  isset($datas['ppnbiayabulanan']) ? $datas['ppnbiayabulanan'] : NULL;
        $statusLayanan =  isset($datas['statusLayanan']) ? $datas['statusLayanan'] : NULL;
        $mediakoneksiLayanan =  isset($datas['mediakoneksiLayanan']) ? $datas['mediakoneksiLayanan'] : NULL;
        $ippublicLayanan =  isset($datas['ippublicLayanan']) ? $datas['ippublicLayanan'] : NULL;
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idLayanan = '$idLayanan', idLayanandetail = '$idLayanandetail', biayaregistrasiLayanan = '$biayaregistrasiLayanan', biayabulananLayanan = '$biayabulananLayanan', biayadasarregistrasiLayanan = '$biayadasarregistrasiLayanan', biayadasarbulananLayanan = '$biayadasarbulananLayanan', ppnbiayaregistrasi = '$ppnbiayaregistrasi', ppnbiayabulanan = '$ppnbiayabulanan', statusLayanan = '$statusLayanan', mediakoneksiLayanan = '$mediakoneksiLayanan', ippublicLayanan = '$ippublicLayanan', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";
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
}
