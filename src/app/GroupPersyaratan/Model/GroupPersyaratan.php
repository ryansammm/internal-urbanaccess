<?php

namespace App\GroupPersyaratan\Model;

use Core\GlobalFunc;
use PDOException;

class GroupPersyaratan extends GlobalFunc
{
    private $table = 'grouplegalitas';
    private $primaryKey = 'idGrouplegalitas';
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
        $id = uniqid('glg');
        $idRelation = $datas['idRelation'];
        $idLegalitas = $datas['idLegalitas'];
        $isiLegalitas = $datas['isiLegalitas'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id', '$idRelation','$idLegalitas', '$isiLegalitas', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
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
    public function update($id, $datas, $where)
    {
        $idRelation = $datas['idRelation'];
        $idLegalitas = $datas['idLegalitas'];
        $isiLegalitas = $datas['isiLegalitas'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idRelation = '$idRelation', idLegalitas = '$idLegalitas', isiLegalitas = '$isiLegalitas', updatedAt = '$updatedAt' " . $where;

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
