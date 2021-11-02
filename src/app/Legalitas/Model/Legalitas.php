<?php

namespace App\Legalitas\Model;

use Core\GlobalFunc;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class Legalitas extends GlobalFunc
{
    private $table = "legalitas";
    private $primaryKey = 'idLegalitas ';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function create($datas)
    {
        $idLegalitas = uniqid('idLegalitas');
        $namaLegalitas = $datas['namaLegalitas'];
        $singkatanLegalitas = $datas['singkatanLegalitas'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idLegalitas', '$namaLegalitas', '$singkatanLegalitas', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idLegalitas;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function singkatanLegalitas($singkatanLegalitas)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE singkatanLegalitas='$singkatanLegalitas' ";
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

    public function selectOne($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;
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
