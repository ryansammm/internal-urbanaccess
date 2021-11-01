<?php

namespace App\InternetUserAlamat\Model;

use Core\GlobalFunc;
use PDOException;

class InternetUserAlamat extends GlobalFunc
{
    private $table = 'internetuseralamat';
    private $primaryKey = 'idInternetuserregistrasi';
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
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function create($noRegistrasi, $datas)
    {
        $idInternetuserregistrasi = uniqid('id');
        $alamat = $datas['alamat'];
        $rt = $datas['rt'];
        $rw = $datas['rw'];
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodepos = $datas['kodepos'];
        $latitude = explode(',', $datas['koordinat'])[0];
        $longtitude = explode(',', $datas['koordinat'])[1];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');
        $jenisAlamat = $datas['jenisAlamat'];

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idInternetuserregistrasi','$noRegistrasi','$alamat', '$rt', '$rw', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan','$kodepos', '$latitude', '$longtitude', '$createdAt', '$updatedAt','$jenisAlamat')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idInternetuserregistrasi;
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

    public function update($id, $datas)
    {
        $alamat = isset($datas['alamat']) ? $datas['alamat'] : NULL;
        $rt = isset($datas['rt']) ? $datas['rt'] : NULL;
        $rw = isset($datas['rw']) ? $datas['rw'] : NULL;
        $idProvinsi = isset($datas['idProvinsi']) ? $datas['idProvinsi'] : NULL;
        $idKabupaten = isset($datas['idKabupaten']) ? $datas['idKabupaten'] : NULL;
        $idKecamatan = isset($datas['idKecamatan']) ? $datas['idKecamatan'] : NULL;
        $idKelurahan = isset($datas['idKelurahan']) ? $datas['idKelurahan'] : NULL;
        $kodepos = isset($datas['kodepos']) ? $datas['kodepos'] : NULL;
        $latitude = explode(',', $datas['koordinat'])[0];
        $longtitude = explode(',', $datas['koordinat'])[1];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET alamat = '$alamat', rt = '$rt', rw = '$rw', idProvinsi = '$idProvinsi', idKabupaten = '$idKabupaten', idKecamatan = '$idKecamatan', idKelurahan = '$idKelurahan', kodepos = '$kodepos', latitude = '$latitude', longtitude = '$longtitude', updatedAt = '$updatedAt' WHERE " . $this->primaryKey . " = '$id'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }


    public function updateJenis($where = "", $datas)
    {
        $alamat = isset($datas['alamat']) ? $datas['alamat'] : NULL;
        $rt = isset($datas['rt']) ? $datas['rt'] : NULL;
        $rw = isset($datas['rw']) ? $datas['rw'] : NULL;
        $idProvinsi = isset($datas['idProvinsi']) ? $datas['idProvinsi'] : NULL;
        $idKabupaten = isset($datas['idKabupaten']) ? $datas['idKabupaten'] : NULL;
        $idKecamatan = isset($datas['idKecamatan']) ? $datas['idKecamatan'] : NULL;
        $idKelurahan = isset($datas['idKelurahan']) ? $datas['idKelurahan'] : NULL;
        $kodepos = isset($datas['kodepos']) ? $datas['kodepos'] : NULL;
        $latitude = explode(',', $datas['koordinat'])[0];
        $longtitude = explode(',', $datas['koordinat'])[1];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET alamat = '$alamat', rt = '$rt', rw = '$rw', idProvinsi = '$idProvinsi', idKabupaten = '$idKabupaten', idKecamatan = '$idKecamatan', idKelurahan = '$idKelurahan', kodepos = '$kodepos', latitude = '$latitude', longtitude = '$longtitude', updatedAt = '$updatedAt'" . $where;
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return true;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }


    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

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
