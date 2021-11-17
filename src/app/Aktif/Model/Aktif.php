<?php

namespace App\Aktif\Model;

use Core\GlobalFunc;
use PDOException;

class Aktif extends GlobalFunc
{
    private $table = 'aktif';
    private $primaryKey = 'idAktif';
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

    public function create($datas, $idRelation)
    {
        $idAktif = uniqid('id-');
        $tanggalBayar = $datas['tanggalPembayaran'];
        $jumlahPembayaran = $datas['jumlahPembayaran'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idAktif','$idRelation', '$tanggalBayar', '$jumlahPembayaran', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idAktif;
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

    public function update($idRelation, $datas)
    {
        $idRelation = $idRelation;
        $tanggalBayar = $datas['tanggalPembayaran'];
        $jumlahPembayaran = $datas['jumlahPembayaran'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idRelation='$idRelation', tanggalPembayaran='$tanggalBayar', jumlahPembayaran='$jumlahPembayaran', jumlahPembayaran='$jumlahPembayaran',updateAt='$updatedAt' WHERE idRelation='$idRelation'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idRelation;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idRelation = '$id'";

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
