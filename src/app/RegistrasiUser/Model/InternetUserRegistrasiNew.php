<?php

namespace App\RegistrasiUser\Model;

use App\QueryBuilder\Model\QueryBuilder;

class InternetUserRegistrasiNew extends QueryBuilder
{
    protected $table = 'internetuserregistrasi';
    protected $primaryKey = 'noRegistrasi';
}
