<?php

namespace App\InputHasilSurveyOnsite\Model;

use Core\GlobalFunc;

class InputHasilSurveyOnsite extends GlobalFunc
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
        $sql = "SELECT userrequestsurvey.*, minat.namaPemohon, layananinternet.namaLayanan, layananinternetdetail.kecepatan, minat.alamat, vendor.namaVendor, minat.status FROM " . $this->table . " LEFT JOIN minat ON minat.kodeMinat = userrequestsurvey.kodeMinat LEFT JOIN vendor ON vendor.idVendor = userrequestsurvey.idVendor LEFT JOIN minatlayanan ON minatlayanan.idMinat = minat.kodeMinat LEFT JOIN layananinternet ON layananinternet.idLayananinternet = minatlayanan.idLayanan LEFT JOIN layananinternetdetail ON layananinternetdetail.idLayananinternetdetail = minatlayanan.idLayanandetail " . $where;
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
        $sql = "SELECT * FROM " . $this->table . "  " . $where;

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
        $nomorRegistrasi = $datas->get('nomorRegistrasi');
        $picRegistrasi = $datas->get('picRegistrasi');
        $idClient = $datas->get('idClient');
        $tanggalRegistrasi = $datas->get('tanggalRegistrasi');
        $idSales = $datas->get('idSales');
        $alamatpasangRegistrasi = $datas->get('alamatpasangRegistrasi');
        $idProvinsi = $datas->get('idProvinsi');
        $idKabupaten = $datas->get('idKabupaten');
        $idKecamatan = $datas->get('idKecamatan');
        $idKelurahan = $datas->get('idKelurahan');
        $idGrouplayanan = $datas->get('idGrouplayanan');
        $mediakoneksiRegistrasi = $datas->get('mediakoneksiRegistrasi');
        $biayaRegistrasi = $datas->get('biayaRegistrasi');
        $bulananRegistrasi = $datas->get('bulananRegistrasi');
        $layananTambahan = $datas->get('layananTambahan');
        $fotorumahRegistrasi = $datas->get('fotorumahRegistrasi');
        $isPic = $datas->get('isPic');
        $ktpPassport = $datas->get('ktpPassport');
        $userId = $datas->get('userId');
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$nomorRegistrasi', '$idGrouplayanan', '$mediakoneksiRegistrasi', '$biayaRegistrasi', '$bulananRegistrasi', '$picRegistrasi', '$alamatpasangRegistrasi', '$idClient', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$fotorumahRegistrasi', '$idSales', '$dateCreate', '$tanggalRegistrasi', '$layananTambahan', '$isPic', '$ktpPassport', '$userId')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $nomorRegistrasi;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($id, $datas)
    {
        $tanggalHasil = $datas['tanggalHasil'];
        $jarak = $datas['jarak'];
        $keterangan = $datas['keterangan'];
        $updatedAt = date('Y-m-d H:i:s');


        $sql = "UPDATE " . $this->table . " SET tanggalHasil = '$tanggalHasil', jarak = '$jarak', keterangan = '$keterangan', updatedAt = '$updatedAt'  WHERE id = '$id'";
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

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE \"idSales\"='$id'";
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
