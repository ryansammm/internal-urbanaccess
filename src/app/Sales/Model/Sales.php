<?php

namespace App\Sales\Model;

use Core\GlobalFunc;

class Sales extends GlobalFunc
{
    private $table = 'sales';
    private $primaryKey = 'nikSales';
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

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " " . $this->primaryKey . " = '$id'";

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
        $nikSales = $datas['nikSales'];
        $namaSales = $datas['namaSales'];
        $singkatanSales = $datas['singkatanSales'];
        $tanggalbergabungSales = $datas['tanggalbergabungSales'];
        $jenisSales = $datas['jenisSales'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$nikSales', '$namaSales', '$singkatanSales', '$tanggalbergabungSales', '$jenisSales', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $nikSales;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $nikSales = $datas['nikSales'];
        $namaSales = $datas['namaSales'];
        $singkatanSales = $datas['singkatanSales'];
        $tanggalbergabungSales = $datas['tanggalbergabungSales'];
        $jenisSales = $datas['jenisSales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET nikSales='$nikSales', namaSales='$namaSales', singkatanSales='$singkatanSales', tanggalbergabungSales='$tanggalbergabungSales', jenisSales='$jenisSales', updatedAt='$updatedAt' WHERE idSales = '$id'";

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


    public function namaSales($namaSales)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE namaSales='$namaSales' ";
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
}
