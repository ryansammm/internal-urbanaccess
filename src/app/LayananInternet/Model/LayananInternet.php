<?php

namespace App\LayananInternet\Model;

use Core\GlobalFunc;
use PDOException;

class LayananInternet extends GlobalFunc
{
    private $table = 'layananinternet';
    private $primaryKey = 'idLayananinternet';
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

    public function create($datas)
    {
        $id = uniqid('lyn');
        $namaLayanan = $datas->get('namaLayanan');
        $biayadasarregistrasiLayanan = $datas->get('biayadasarregistrasiLayanan');
        $biayaregistrasi = $datas->get('biayaregistrasi');
        $ppn = $datas->get('ppn');
        $tampil = $datas->get('tampil');
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        $kodeLayanan = $datas->get('kodeLayanan');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$namaLayanan','$biayadasarregistrasiLayanan','$biayaregistrasi','$ppn','$tampil','$createdAt','$updatedAt','$kodeLayanan')";

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
        $namaLayanan = $datas->get('namaLayanan');
        $biayadasarregistrasiLayanan = $datas->get('biayadasarregistrasiLayanan');
        $biayaregistrasi = $datas->get('biayaregistrasi');
        $ppn = $datas->get('ppn');
        $tampil = $datas->get('tampil');
        $updatedAt = date('Y-m-d H:i:s');
        $kodeLayanan = $datas->get('kodeLayanan');

        $sql = "UPDATE " . $this->table . " SET namaLayanan = '$namaLayanan', biayadasarregistrasiLayanan = '$biayadasarregistrasiLayanan', biayaregistrasi = '$biayaregistrasi', ppn = '$ppn', tampil = '$tampil', updatedAt = '$updatedAt', kodeLayanan = '$kodeLayanan' WHERE " . $this->primaryKey . " = '$id'";

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

    public function namaLayanan($namaLayanan)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE namaLayanan='$namaLayanan' ";


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
