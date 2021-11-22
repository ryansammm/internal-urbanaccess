<?php

namespace App\QueryBuilderExample;

use App\QueryBuilder\Model\QueryBuilder;

class ModelExample extends QueryBuilder
{
    protected $table = 'table_name';
    protected $primaryKey = 'id';
}
