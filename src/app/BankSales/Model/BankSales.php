<?php

namespace App\BankSales\Model;

use Core\GlobalFunc;

class BankSales extends GlobalFunc
{
    private $table = 'banksales';
    private $primaryKey = 'idBanksales';
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

    public function create($idRelation, $datas)
    {
        $idBanksales = uniqid('idBanksales');
        $idBank = $datas['idBank'];
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

    public function update($idRelation, $datas)
    {
        $idBank = $datas['idBank'];
        $norekeningBanksales = $datas['norekeningBanksales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idBank='$idBank', idRelation='$idRelation', norekeningBanksales='$norekeningBanksales', updatedAt='$updatedAt' WHERE idRelation = '$idRelation'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idRelation;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($where = "")
    {
        $sql = "DELETE FROM " . $this->table . " " . $where;


        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $data;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }
}
