<?php

namespace App\Minat\Model;

use App\QueryBuilder\Model\QueryBuilder;

class MinatNew extends QueryBuilder
{
    protected $table = 'minat';
    protected $primaryKey = 'idMinat';
}
