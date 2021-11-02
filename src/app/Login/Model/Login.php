<?php

namespace App\Login\Model;

use Core\GlobalFunc;

class Login extends GlobalFunc
{
    private $table = 'users';
    public $conn;

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function isPrevillege($privillege)
    {
        $sql = "SELECT user.* FROM jabatan INNER JOIN staff ON jabatan.idJabatan = staff.jabatanStaff  INNER JOIN user ON staff.idStaff = user.idStaff WHERE jabatan.privillegeJabatan = '$privillege'"; // buat queri select
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(); // jalankan query

        return $stmt; // mengecek row
    }
}
