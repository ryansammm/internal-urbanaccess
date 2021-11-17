<?php

namespace App\Client\Model;

use Core\GlobalFunc;

class Client extends GlobalFunc
{
    private $table = 'client';
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
        $sql = "SELECT * FROM \"".$this->table."\" WHERE \"idClient\" = '$id'";

        $query = pg_query($this->conn, $sql);
        $data = pg_fetch_assoc($query);

        return $data;
    }

    public function create($data)
    {
        $idClient = uniqid('cln');
        $idRelation = $this->esc_str($this->conn, $data['idRelation']);
        $dateCreate = date('Y-m-d');

        $sql = "INSERT INTO \"".$this->table."\" VALUES ('$idClient', '$idRelation', '$dateCreate')";
        $query = pg_query($sql);

        return $idClient;
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
