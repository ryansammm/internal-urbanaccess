<?php

namespace App\Kontak\Model;

use Core\GlobalFunc;
use PDOException;

class Kontak extends GlobalFunc
{
    private $table = 'kontak';
    private $primaryKey = 'idKontak';
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

    public function create($datas)
    {
        $idKontak = uniqid('idKontak');
        $namaKontak = $datas['namaKontak'];
        $logoKontak = $datas['logoKontak'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idKontak', '$namaKontak','$logoKontak', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idKontak;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas, $where)
    {
        $namaKontak = $datas['namaKontak'];
        $logoKontak = $datas['logoKontak'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET namaKontak = '$namaKontak', logoKontak = '$logoKontak', updatedAt = '$updatedAt' " . $where;

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
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function namaKontak($namaKontak)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE namaKontak='$namaKontak' ";
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

    public function idKontak($idKontak)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idKontak='$idKontak' ";
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
