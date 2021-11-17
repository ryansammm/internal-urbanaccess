<?php

namespace App\Kelurahan\Model;

use Core\GlobalFunc;
use PDOException;

class Kelurahan extends GlobalFunc
{
    private $table = 'kelurahan';
    private $primaryKey = 'idKelurahan';
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

    public function get($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE idKecamatan = '$id'";

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
        $id = $datas->get('id');
        $name = $datas->get('name');
        $idKecamatan = $datas->get('idKecamatan');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$idKecamatan','$name')";

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
        $name = $datas->get('name');
        $idKecamatan = $datas->get('idKecamatan');

        $sql = "UPDATE " . $this->table . " SET name = '$name', idKecamatan = '$idKecamatan' WHERE " . $this->primaryKey . " = '$id'";

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

    public function kelurahan($kelurahan)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE name='$kelurahan' ";
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
