<?php

namespace App\SalesAlamat\Model;

use Core\GlobalFunc;

class SalesAlamat extends GlobalFunc
{
    private $table = 'salesalamat';
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

    public function selectOnePerorangan($where = "")
    {
        $sql = "SELECT *, provinsi.id as idProvinsi, provinsi.name as nameProvinsi, kabupaten.id as idKabupaten, kabupaten.name as nameKabupaten, kecamatan.id as idKecamatan, kecamatan.name as nameKecamatan, kelurahan.id as idKelurahan, kelurahan.name as nameKelurahan FROM " . $this->table . " LEFT JOIN provinsi ON provinsi.id = salesalamat.idProvinsi LEFT JOIN kabupaten ON kabupaten.id = salesalamat.idKabupaten LEFT JOIN kecamatan ON kecamatan.id = salesalamat.idKecamatan LEFT JOIN kelurahan ON kelurahan.id = salesalamat.idKelurahan " . $where;

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

    public function create($idSales, $datas, $status)
    {
        $idSalesalamat =  uniqid('idSalesalamat');
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodeposVendor = $datas['kodeposSalesalamat'];
        $alamatSales = $datas['alamatSales'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idSalesalamat','$idSales', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$kodeposVendor', '$alamatSales', '$status', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idSalesalamat;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function createSaatIni($idSales, $datas, $status)
    {
        $idSalesalamat =  uniqid('idSalesalamat');
        $idProvinsi = $datas['idProvinsiSaatIni'];
        $idKabupaten = $datas['idKabupatenSaatIni'];
        $idKecamatan = $datas['idKecamatanSaatIni'];
        $idKelurahan = $datas['idKelurahanSaatIni'];
        $kodeposVendor = $datas['kodeposSalesalamatSaatIni'];
        $alamatSales = $datas['alamatSalesSaatIni'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idSalesalamat','$idSales', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$kodeposVendor', '$alamatSales', '$status', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idSalesalamat;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function createIdentitas($idSales, $datas, $status)
    {
        $idSalesalamat =  uniqid('idSalesalamat');
        $idProvinsi = $datas['idProvinsiIdentitas'];
        $idKabupaten = $datas['idKabupatenIdentitas'];
        $idKecamatan = $datas['idKecamatanIdentitas'];
        $idKelurahan = $datas['idKelurahanIdentitas'];
        $kodeposVendor = $datas['kodeposSalesalamatIdentitas'];
        $alamatSales = $datas['alamatSalesIdentitas'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idSalesalamat','$idSales', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$kodeposVendor', '$alamatSales', '$status', '$createdAt', '$updatedAt')";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idSalesalamat;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function update($idSales, $datas, $status)
    {
        $idProvinsi = $datas['idProvinsi'];
        $idKabupaten = $datas['idKabupaten'];
        $idKecamatan = $datas['idKecamatan'];
        $idKelurahan = $datas['idKelurahan'];
        $kodeposSalesalamat = $datas['kodeposSalesalamat'];
        $alamatSales = $datas['alamatSales'];
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idProvinsi='$idProvinsi', idKabupaten='$idKabupaten', idKecamatan='$idKecamatan', idKelurahan='$idKelurahan', kodeposSalesalamat='$kodeposSalesalamat', alamatSales='$alamatSales', status='$status', updatedAt='$updatedAt' WHERE idSales='$idSales'";

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idSales;
        } catch (\PDOException $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idSales = '$id'";

        try {
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query;
        } catch (\PDOException $e) {
            dump($e);
            die();
        }
    }

    public function deleteSaatIni($where = "")
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

    public function deleteIdentitas($where = "")
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
