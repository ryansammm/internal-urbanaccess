<?php

namespace App\InputHasilSoftSurvey\Model;

use Core\GlobalFunc;

class InputHasilSoftSurvey extends GlobalFunc
{
    private $table = 'userrequestsurvey';
    private $primaryKey = 'id';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT userrequestsurvey.tanggalRequest, userrequestsurvey.kodeMinat, minat.namapemohon, layananinternet.namaLayanan, minat.alamat, userrequestsurvey.hasil FROM " . $this->table . " LEFT JOIN vendor ON vendor.idVendor = userrequestsurvey.idVendor LEFT JOIN minat ON minat.kodeMinat = userrequestsurvey.kodeMinat LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan " . $where;
        // dd($sql);

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

    public function selectAllInput($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN vendor ON vendor.idVendor = userrequestsurvey.idVendor LEFT JOIN minat ON minat.kodeMinat = userrequestsurvey.kodeMinat LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan " . $where;
        // dd($sql);

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
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN vendor ON vendor.idVendor = userrequestsurvey.idVendor LEFT JOIN minat ON minat.kodeMinat = userrequestsurvey.kodeMinat " . $where;
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

    public function create($datas)
    {
        $id = uniqid('id');
        $idVendor = $datas['idVendor'];
        $kodeMinat = $datas['kodeMinat'];
        $tanggalRequest = $datas['tanggalRequest'];
        $tanggalHasil = $datas['tanggalHasil'];
        $hasil = $datas['hasil'];
        $jarak = $datas['jarak'];
        $biayaInstalasi = $datas['biayaInstalasi'];
        $keterangan = $datas['keterangan'];
        $jenisSurvey = $datas['jenisSurvey'];
        $status = NULL;
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$id', '$idVendor', '$kodeMinat', '$tanggalRequest', '$tanggalHasil', '$hasil', '$jarak', '$biayaInstalasi', '$keterangan', '$jenisSurvey', '$status' ,'$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($datas, $where = "")
    {
        $idVendor = $datas['idVendor'];
        $kodeMinat = $datas['kodeMinat'];
        $tanggalHasil = $datas['tanggalHasil'];
        $hasil = $datas['hasil'];
        $jarak = $datas['jarak'];
        $biayaInstalasi = $datas['biayaInstalasi'];
        $keterangan = $datas['keterangan'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idVendor='$idVendor', kodeMinat='$kodeMinat', tanggalHasil='$tanggalHasil', hasil='$hasil', jarak='$jarak', biayaInstalasi='$biayaInstalasi', keterangan='$keterangan', updatedAt='$updatedAt' " . $where;

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idVendor;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($where = "")
    {
        $sql = "DELETE FROM " . $this->table . " " . $where;

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (\PDOException $e) {
            dump($e);
            die();
        }
    }
}
