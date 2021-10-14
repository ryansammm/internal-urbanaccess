<?php

namespace App\DataUser\Model;

use Core\GlobalFunc;

class DataUser extends GlobalFunc
{
    private $table = 'sales';
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
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

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
        $nomorRegistrasi = $datas->get('nomorRegistrasi');
        $picRegistrasi = $datas->get('picRegistrasi');
        $tanggalRegistrasi = $datas->get('tanggalRegistrasi');
        $alamatpasangRegistrasi = $datas->get('alamatpasangRegistrasi');
        $mediakoneksiRegistrasi = $datas->get('mediakoneksiRegistrasi');
        $biayaRegistrasi = $datas->get('biayaRegistrasi');
        $bulananRegistrasi = $datas->get('bulananRegistrasi');
        $layananTambahan = $datas->get('layananTambahan');
        $fotorumahRegistrasi = $datas->get('fotorumahRegistrasi');
        $isPic = $datas->get('isPic');
        $ktpPassport = $datas->get('ktpPassport');

        $sql = "UPDATE " . $this->table . " SET nomorRegistrasi='$nomorRegistrasi', picRegistrasi='$picRegistrasi', tanggalRegistrasi='$tanggalRegistrasi', alamatpasangRegistrasi='$alamatpasangRegistrasi', mediakoneksiRegistrasi='$mediakoneksiRegistrasi', biayaRegistrasi='$biayaRegistrasi', bulananRegistrasi='$bulananRegistrasi', layananTambahan='$layananTambahan', fotorumahRegistrasi='$fotorumahRegistrasi', isPic='$isPic', ktpPassport='$ktpPassport' WHERE idSales='$id'";

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
