<?php

namespace App\InternetUserVendor\Model;

use Core\GlobalFunc;
use PDOException;

class InternetUserVendor extends GlobalFunc
{
    private $table = 'internetuservendor';
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
        // dd($datas);
        $id = uniqid('id');
        $idVendor = $datas['idVendor'];
        $namaVendor = $datas['namaVendor'];
        $jenislinkVendor = $datas['jenislinkVendor'];
        $mediakoneksiVendor = $datas['mediakoneksiVendor'];
        $biayaregistrasi = $datas['biayaregistrasiLayanan'];
        $biayabulanan = $datas['biayabulananLayanan'];
        $ppnbiayainstalasi = $datas['ppnbiayainstalasi'];
        $ppnbiayabulanan = $datas['ppnbiayabulanan'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$idInternetuserregistrasi','$idVendor', '$namaVendor', '$jenislinkVendor', '$mediakoneksiVendor', '$biayaregistrasi', '$biayabulanan', '$ppnbiayainstalasi', '$ppnbiayabulanan', '$createdAt', '$updatedAt')";
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

    public function update($id, $datas)
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
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idLayanan = '$idLayanan', idLayanandetail = '$idLayanandetail', biayaregistrasiLayanan = '$biayaregistrasiLayanan', biayabulananLayanan = '$biayabulananLayanan', biayadasarregistrasiLayanan = '$biayadasarregistrasiLayanan', biayadasarbulananLayanan = '$biayadasarbulananLayanan', ppnbiayaregistrasi = '$ppnbiayaregistrasi', ppnbiayabulanan = '$ppnbiayabulanan', statusLayanan = '$statusLayanan', mediakoneksiLayanan = '$mediakoneksiLayanan', ippublicLayanan = '$ippublicLayanan', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

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

    public function namaVendor($namaVendor)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE namaVendor='$namaVendor' ";
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

    public function jenisVendor($jenisVendor)
    {
        $jenis = '';

        if ($jenisVendor = "Link Utama") {
            $jenis = '0';
        } else {
            $jenis = '1';
        };

        return $jenis;
    }

    public function mediakoneksiVendor($mediakoneksiVendor)
    {

        $media = '';

        if ($mediakoneksiVendor = "Fiber Optic") {
            $media = '0';
        } else {
            $media = '1';
        }

        return $media;
    }
}
