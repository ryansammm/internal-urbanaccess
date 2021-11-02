<?php

namespace App\PIC\Model;

use Core\GlobalFunc;
use PDOException;

class PIC extends GlobalFunc
{
    private $table = 'pic';
    private $primaryKey = 'nikPic';
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
        $idPic = uniqid('idPIC');
        $nikPic = $datas['nikPic'];
        $namaPic = $datas['namaPic'];
        $jenisPic = isset($datas['jenisPic']) ? $datas['jenisPic'] : NULL;
        $tanggallahirPic = isset($datas['tanggallahirPic']) ? $datas['tanggallahirPic'] : NULL;
        $statusPic = $datas['statusPic'];
        $jabatanPic = isset($datas['jabatanPic']) ? $datas['jabatanPic'] : NULL;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idPic','$nikPic','$namaPic', '$jenisPic', '$tanggallahirPic', '$statusPic', '$jabatanPic', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $nikPic;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";
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

    public function update($id, $datas, $where)
    {
        $nikPic = $datas['nikPic'];
        $namaPic = $datas['namaPic'];
        $tempatlahirPic = $datas['tempatlahirPic'];
        $tanggallahirPic = $datas['tanggallahirPic'];
        $statusPic = $datas['statusPic'];
        $jabatanPic = $datas['jabatanPic'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET nikPic = '$nikPic', namaPic = '$namaPic', tempatlahirPic = '$tempatlahirPic', tanggallahirPic = '$tanggallahirPic', statusPic = '$statusPic', jabatanPic = '$jabatanPic', updatedAt = '$updatedAt' " . $where;

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($where = "")
    {
        $sql = "DELETE FROM " . $this->table . " " . $where;
        // dd($sql);

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function namaPIC($namaPIC)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE namaPIC='$namaPIC' ";
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
}
