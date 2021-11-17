<?php

namespace App\GroupLegalitas\Model;

use Core\GlobalFunc;
use PDOException;
use Symfony\Component\HttpFoundation\Request;

class GroupLegalitas extends GlobalFunc
{
    private $table = "grouplegalitas";
    private $primaryKey = 'idGrouplegalitas';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function create($datas)
    {
        $idGrouplegalitas = uniqid('idGrouplegalitas');
        $idRelation = $datas['idRelation'];
        $idLegalitas = $datas['idLegalitas'];
        $isiLegalitas = $datas['isiLegalitas'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idGrouplegalitas','$idRelation', '$idLegalitas', '$isiLegalitas', '$createdAt', '$updatedAt')";
        // dd($datas);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idRelation;
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

    public function delete($where = "")
    {
        $sql = "DELETE FROM " . $this->table . " " . $where;
        // dd($sql);

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
