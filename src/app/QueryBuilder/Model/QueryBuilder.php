<?php

namespace App\QueryBuilder\Model;

use App\QueryBuilder\Model\Query;
use Core\GlobalFunc;

class QueryBuilder extends Query
{
    /**
     * @var string
     */
    protected $sql = "";
    protected $conn = "";

    public function __construct()
    {
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    /**
     * @return array
     */
    public function exec_get_all()
    {
        $query = $this->conn->prepare($this->sql);
        $query->execute();
        $this->err_query($query);

        $datas = $query->fetchAll();
        $this->sql = "";

        return $datas;
    }

    /**
     * @return array
     */
    public function exec_get_one()
    {
        $query = $this->conn->prepare($this->sql);
        $query->execute();
        $this->err_query($query);

        $datas = $query->fetch();
        $this->sql = "";

        return $datas;
    }

    /**
     * @return ModelCollection
     */
    public function to_model_collection()
    {
        $param = func_get_args();
        $modelCollection = new ModelCollection;
        $modelCollection->items = $param[0];

        if (isset($param[1])) {
            $paginator = new Paginator;
            $paginator->setProp($param[1]);
            $modelCollection->pagination = $paginator;
        }

        return $modelCollection;
    }

    public function to_paginator()
    {
        $param = func_get_args();
        $paginator = new Paginator;
        $paginator->setProp($param[1]);
        $paginator->setItems($param[0]);

        return $paginator;
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->generateSql();
        // dd($this->sql);

        return $this->exec_get_all();
    }

    /**
     * @return array
     */
    public function count()
    {
        $this->query['table'] = "" . $this->table . "";

        $this->sql = "SELECT COUNT(*) AS count";
        foreach ($this->query as $key => $value) {
            if ($key == 'table') {
                $this->sql .= " FROM ";
            }
            if ($key != 'select') {
                $this->sql .= $value;
            }
        }


        return $this->exec_get_one();
    }

    /**
     * @return QueryBuilder
     */
    public function paginate(int $result_per_page)
    {
        $page = !isset($_REQUEST['page']) || $_REQUEST['page'] == null ? 1 : $_REQUEST['page'];
        $countRows = $this->count()['count'];
        $page_first_result = ($page - 1) * $result_per_page;
        $number_of_page = ceil($countRows / $result_per_page);

        $datas = $this->limit($result_per_page, $page_first_result)->get();

        $pagination = [
            'current_page' => intval($page),
            'number_of_page' => intval($number_of_page),
            'page_first_result' => $page_first_result,
            'result_per_page' => $result_per_page,
            'countRows' => intval($countRows),
            'total_data_per_page' => ($result_per_page * ($page - 1)) + count($datas)
        ];

        $paginator = $this->to_paginator($datas, $pagination);

        return $paginator;
    }
}
