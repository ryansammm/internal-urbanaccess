<?php

namespace App\GroupPIC\Model;

use Core\GlobalFunc;
use PDOException;

class GroupPIC extends GlobalFunc
{
    private $table = 'grouppic';
    private $primaryKey = 'idGrouppic';
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
        $id = uniqid('gpc');
        $nikPic = $datas['nikPic'];
        $idRelation = $datas['idRelation'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id', '$nikPic', '$idRelation', '$createdAt', '$updatedAt')";
        // dd($sql);
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
        $id = uniqid('gpc');
        $nikPic = $datas['nikPic'];
        $idRelation = $datas['idRelation'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET nikPic = '$nikPic', idRelation = '$idRelation', updatedAt = '$updatedAt' " . $where;

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
