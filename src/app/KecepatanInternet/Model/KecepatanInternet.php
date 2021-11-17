<?php

namespace App\KecepatanInternet\Model;

use Core\GlobalFunc;
use PDOException;

class KecepatanInternet extends GlobalFunc
{
    private $table = 'layananinternetdetail';
    private $primaryKey = 'idLayananinternetdetail';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT *, " . $this->table . ".ppn as ppnLayanandetail FROM " . $this->table . " LEFT JOIN layananinternet ON layananinternet.idLayananinternet = " . $this->table . ".idLayananinternet " . $where;

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
        // $sql = "SELECT *, " . $this->table . ".ppn as ppnLayanandetail FROM " . $this->table . "  LEFT JOIN layananinternet ON layananinternet.idLayananinternet = " . $this->table . ".idLayananinternet WHERE " . $this->primaryKey . " = '$id'";

        $sql = "SELECT * FROM " . $this->table . "  LEFT JOIN layananinternet ON layananinternet.idLayananinternet = layananinternetdetail.idLayananinternet WHERE layananinternetdetail.idLayananinternetdetail = '$id'";

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

    public function create($datas)
    {
        $id = uniqid('ldt');
        $idLayananinternet = $datas->get('idLayananinternet');
        $kecepatan = $datas->get('kecepatan');
        $biayadasarbulanan = $datas->get('biayadasarbulanan');
        $biayabulanan = $datas->get('biayabulanan');
        $ppn = $datas->get('ppn');
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id','$idLayananinternet','$kecepatan','$biayadasarbulanan','$biayabulanan','$ppn','$createdAt','$updatedAt')";

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
        $idLayananinternet = $datas->get('idLayananinternet');
        $kecepatan = $datas->get('kecepatan');
        $biayadasarbulanan = $datas->get('biayadasarbulanan');
        $biayabulanan = $datas->get('biayabulanan');
        $ppn = $datas->get('ppn');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idLayananinternet = '$idLayananinternet', kecepatan = '$kecepatan', biayadasarbulanan = '$biayadasarbulanan', biayabulanan = '$biayabulanan', ppn = '$ppn', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

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
}
