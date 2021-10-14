<?php

namespace App\People\Model;

use Core\GlobalFunc;

class People extends GlobalFunc
{
    private $table = 'people';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM \"".$this->table."\"";
        $query = pg_query($this->conn, $sql);
        $datas = [];
        while ($item = pg_fetch_assoc($query)) {
            array_push($datas, $item);
        }

        return $datas;
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM \"".$this->table."\" WHERE \"idPeople\" = '$id'";

        $query = pg_query($this->conn, $sql);
        $data = pg_fetch_assoc($query);

        return $data;
    }

    public function create($data)
    {
        $idPeople = uniqid('pep');
        $namaPeople = $this->esc_str($this->conn, $data['namaPeople']);
        $nikPeople = 0;
        $nipPeople = 0;
        $alamatPeople = $this->esc_str($this->conn, $data['alamatPeople']);
        $idProvinsi = $this->esc_str($this->conn, $data['idProvinsi']);
        $idKabupaten = $this->esc_str($this->conn, $data['idKabupaten']);
        $idKecamatan = $this->esc_str($this->conn, $data['idKecamatan']);
        $idKelurahan = $this->esc_str($this->conn, $data['idKelurahan']);
        $telponPeople = $this->esc_str($this->conn, $data['telponPeople']);
        $mobilePeople = $this->esc_str($this->conn, $data['mobilePeople']);
        $emailPeople = $this->esc_str($this->conn, $data['emailPeople']);
        $websitePeople = $this->esc_str($this->conn, $data['websitePeople']);
        $fotoPeople = $this->esc_str($this->conn, $data['fotoPeople']);
        $idJabatan = $this->esc_str($this->conn, $data['idJabatan']);
        $idPendidikan = $this->esc_str($this->conn, $data['idPendidikan']);
        $idSosialmedia = $this->esc_str($this->conn, $data['idSosialmedia']);
        $idUser = $this->esc_str($this->conn, $data['idUser']);
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO \"".$this->table."\" VALUES ('$idPeople', '$namaPeople', '$nikPeople', '$nipPeople', '$alamatPeople', '$idProvinsi', '$idKabupaten', '$idKecamatan', '$idKelurahan', '$telponPeople', '$mobilePeople', '$emailPeople', '$websitePeople', '$fotoPeople', '$idJabatan', '$idPendidikan', '$idSosialmedia', '$idUser', '$dateCreate')";
        $query = pg_query($sql);

        return $idPeople;
    }

    public function update($idClient, $namaBank)
    {
        $namaBank = $this->esc_str($this->conn, $namaBank);

        $sql = "UPDATE ".$this->table." SET \"namaBank\"='$namaBank' WHERE \"idClient\"='$idClient'";
        $query = pg_query($sql);

        return pg_affected_rows($query);
    }

    public function delete($idClient)
    {
        $sql = "DELETE FROM ".$this->table." WHERE \"idClient\"='$idClient'";
        $query = pg_query($sql);

        return pg_affected_rows($query);
    }
}
