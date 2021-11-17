<?php

namespace App\AturTanggalOnsite\Model;

use Core\GlobalFunc;

class AturTanggalOnsite extends GlobalFunc
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
        $id = uniqid('id');
        $idVendor = $datas['idVendor'];
        $kodeMinat = $datas['kodeMinat'];
        $tanggalRequest = date('Y-m-d H:i:s');
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
