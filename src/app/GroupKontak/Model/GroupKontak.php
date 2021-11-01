<?php

namespace App\GroupKontak\Model;

use Core\GlobalFunc;
use PDOException;

class GroupKontak extends GlobalFunc
{
    private $table = 'groupkontak';
    private $primaryKey = 'idRelation';
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
        $idGroupkontak = uniqid('igk');
        $idRelation = $datas['idRelation'];
        $idKontak = $datas['idKontak'];
        $isiKontak = $datas['isiKontak'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idGroupkontak', '$idRelation','$idKontak', '$isiKontak', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idRelation;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;
        dd($sql);

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
        $idRelation = $datas['idRelation'];
        $idKontak = $datas['idKontak'];
        $isiKontak = $datas['isiKontak'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idRelation = '$idRelation', idKontak = '$idKontak', isiKontak = '$isiKontak', updatedAt = '$updatedAt' " . $where;

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
