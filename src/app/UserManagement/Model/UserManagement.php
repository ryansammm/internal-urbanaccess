<?php

namespace App\UserManagement\Model;

use Core\GlobalFunc;
use PDOException;

class UserManagement extends GlobalFunc
{
    private $table = 'users';
    private $primaryKey = 'idUser';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function selectAll($where = "")
    {
        $sql = "SELECT * FROM " . $this->table . " LEFT JOIN roles ON roles.idRole = users.idRole " . $where;
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

    public function create($datas)
    {
        $idUser = uniqid('id');
        $idRole = $datas['idRole'];
        $nikUser = $datas['nikUser'];
        $namaUser = $datas['namaUser'];
        $username = $datas['username'];
        $password = password_hash($datas['password'], PASSWORD_DEFAULT);
        $chatId = '-1001571974882';
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO " . $this->table . " VALUES ('$idUser','$idRole', '$nikUser', '$namaUser', '$username', '$password', '$chatId', '$createdAt', '$updatedAt')";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $idUser;
        } catch (PDOException $e) {
            echo $e;
            die();
        }
    }

    public function selectOne($id)
    {
        $sql = "SELECT * FROM " . $this->table .  " LEFT JOIN roles ON roles.idRole = users.idRole WHERE idUser = '$id'";
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
        $idRole = $datas['idRole'];
        $nikUser = $datas['nikUser'];
        $namaUser = $datas['namaUser'];
        $username = $datas['username'];
        $password = $datas['password'];
        $chatId = '-1001571974882';
        $updatedAt = date('Y-m-d H:i:s');

        $sql = "UPDATE " . $this->table . " SET idRole='$idRole', nikUser='$nikUser', namaUser='$namaUser', username='$username', password='$password', chatId='$chatId', updatedAt='$updatedAt' WHERE idUser='$id'";
        // dd($sql);

        try {
            $data = $this->conn->prepare($sql);
            $data->execute();

            return $id;
        } catch (PDOexception $e) {
            echo $e;
            die();
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE idUser = '$id'";

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
