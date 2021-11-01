<?php

namespace App\FeeSales\Model;

use Core\GlobalFunc;

class FeeSales extends GlobalFunc
{
    private $table = 'feesales';
    private $primaryKey = 'idFeeSales';
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

    public function selectOne($where = " ")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;

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

    public function create($idUser, $datas)
    {
        $idFeeSales = uniqid('fee-');
        $idSales = $datas['idSales'];
        $feeSales = $datas['feeSales'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idFeeSales', '$idSales', '$idUser', '$feeSales', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idFeeSales;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $idSales = $datas['idSales'];
        $idUser = $datas['idUser'];
        $feeSales = $datas['feeSales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idSales='$idSales', idUser='$idUser', feeSales='$feeSales', updatedAt='$updatedAt' WHERE idSales = '$id'";

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
