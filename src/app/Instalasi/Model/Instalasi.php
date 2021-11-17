<?php

namespace App\Instalasi\Model;

use Core\GlobalFunc;
use PDOException;

class Instalasi extends GlobalFunc
{
    private $table = 'instalasi';
    private $primaryKey = 'idInstalasi';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " " . $where;
        // dd($sql);

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

    public function create($datas, $noRegistrasi)
    {
        $idInstalasi = uniqid('id-');
        $tglInstalasi = $datas['tglInstalasi'];
        $jarak = $datas['jarak'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idInstalasi','$noRegistrasi', '$tglInstalasi', '$jarak', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idInstalasi;
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

    public function update($datas, $noRegistrasi)
    {
        $noRegistrasi = $noRegistrasi;
        $tglInstalasi = $datas['tglInstalasi'];
        $jarak = $datas['jarak'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET noRegistrasi='$noRegistrasi', tglInstalasi='$tglInstalasi', jarak='$jarak',  updateAt='$updatedAt' WHERE noRegistrasi='$noRegistrasi'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $noRegistrasi;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE noRegistrasi = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            dump($e);
            die();
        }
    }

    public function chronologyMessage($action, $user, $object)
    {
        $message = [
            'store' => $user . " telah menambah provinsi \"" . $object['provinsi'] . "\"",
            'update' => $user . " telah mengubah provinsi \"" . $object['provinsi'] . "\"",
            'delete' => $user . " telah menghapus provinsi \"" . $object['provinsi'] . "\""
        ];

        return $message[$action];
    }
}
