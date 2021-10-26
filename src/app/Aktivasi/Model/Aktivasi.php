<?php

namespace App\Aktivasi\Model;

use Core\GlobalFunc;
use PDOException;

class Aktivasi extends GlobalFunc
{
    private $table = 'aktivasi';
    private $primaryKey = 'idAktivasi';
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
        $idAktivasi = uniqid('id-');
        $noRegistrasi = $noRegistrasi;
        $tglAktivasi = $datas['tglAktivasi'];
        $idLayanan = $datas['idLayanan'];
        $vlan = $datas['vlan'];
        $macAddress = $datas['macAddress'];
        $serialNumber = $datas['serialNumber'];
        $jenisIp = $datas['jenisIp'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idAktivasi','$noRegistrasi', '$tglAktivasi', '$idLayanan','$vlan','$macAddress','$serialNumber','$jenisIp', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idAktivasi;
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

    public function update($noRegistrasi, $datas)
    {
        $noRegistrasi = $noRegistrasi;
        $tglAktivasi = $datas['tglAktivasi'];
        $idLayanan = $datas['idLayanan'];
        $vlan = $datas['vlan'];
        $macAddress = $datas['macAddress'];
        $serialNumber = $datas['serialNumber'];
        $jenisIp = $datas['jenisIp'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idRelation='$noRegistrasi', tglAktivasi='$tglAktivasi', idLayanan='$idLayanan', vlan='$vlan',macAddress='$macAddress',serialNumber='$serialNumber',jenisIp='$jenisIp' , updateAt='$updatedAt' WHERE idRelation='$noRegistrasi'";
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
