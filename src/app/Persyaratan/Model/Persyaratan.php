<?php

namespace App\Persyaratan\Model;

use Core\GlobalFunc;

class Persyaratan extends GlobalFunc
{
    private $table = 'persyaratan';
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
        $sql = "SELECT * FROM \"".$this->table."\" WHERE \"idPersyaratan\" = '$id'";

        $query = pg_query($this->conn, $sql);
        $data = pg_fetch_assoc($query);

        return $data;
    }

    public function create($data)
    {
        $idPersyaratan = uniqid('pst');
        $namaPersyaratan = $this->esc_str($this->conn, $data['namaPersyaratan']);
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO \"".$this->table."\" VALUES ('$idPersyaratan', '$namaPersyaratan', '$dateCreate')";
        $query = pg_query($sql);

        return $idPersyaratan;
    }

    public function update($idLayanan, $namaBank)
    {
        $namaBank = $this->esc_str($this->conn, $namaBank);

        $sql = "UPDATE ".$this->table." SET \"namaBank\"='$namaBank' WHERE \"idPersyaratan\"='$idLayanan'";
        $query = pg_query($sql);

        return pg_affected_rows($query);
    }

    public function delete($idLayanan)
    {
        $sql = "DELETE FROM ".$this->table." WHERE \"idPersyaratan\"='$idLayanan'";
        $query = pg_query($sql);

        return pg_affected_rows($query);
    }
}
