<?php

namespace App\Bank\Model;

use Core\GlobalFunc;

class Bank extends GlobalFunc
{
    private $table = 'bank';
    private $primaryKey = 'idBank';
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
        } catch (\PDOException $e) {
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
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($datas)
    {
        $idBanksales = uniqid('idBanksales');
        $idBank = $datas['idBank'];
        $idRelation = $datas['idRelation'];
        $norekeningBanksales = $datas['norekeningBanksales'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idBanksales' ,'$idBank', '$idRelation', '$norekeningBanksales','$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idBank;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $idBank = $datas['idBank'];
        $idRelation = $datas['idRelation'];
        $norekeningBanksales = $datas['norekeningBanksales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idBank='$idBank', idRelation='$idRelation', norekeningBanksales='$norekeningBanksales', updatedAt='$updatedAt' WHERE idSales = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (\PDOException $e) {
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
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }
}
