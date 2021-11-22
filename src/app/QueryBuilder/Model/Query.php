<?php

namespace App\QueryBuilder\Model;

class Query
{
    /**
     * @var array
     */
    protected $query = [
        'select' => "",
        'table' => "",
        'join' => "",
        'where' => "",
        'groupBy' => "",
        'orderBy' => "",
        'limit' => ""
    ];

    /**
     * @var string
     */
    protected $queryString = "";

    /**
     * Method to generate the base format of `WHERE` query
     * 
     * @return string
     */
    protected function generateWhere()
    {
        $param = func_get_args()[0];

        if (count(explode(".", $param[0])) > 1) {
            $column = "" . explode(".", $param[0])[0] . "." . explode(".", $param[0])[1] . "";
        } else {
            $column = "" . $param[0] . "";
        }

        if (count($param) == 3) {
            $where = $this->query['where'] . $column . " " . $param[1] . " '" . $param[2] . "'";
        } else {
            $where = $this->query['where'] . $column . " = '" . $param[1] . "'";
        }
        $this->query['where'] = $where;

        return $where;
    }

    /**
     * Method to make the `SELECT` part of the query
     * 
     * @param string
     * @return QueryBuilder
     */
    public function select($select)
    {
        $param = func_get_args();

        foreach ($param as $key => $value) {
            if ($key == 0) {
                $this->query['select'] .= "";
            } else {
                $this->query['select'] .= ", ";
            }

            $column = explode(" as ", $value);
            if (count(explode(" as ", $value)) > 1) {
                $column = "" . $column[0] . " as " . $column[1] . "";
            } else {
                $column = "" . $column[0] . "";
            }

            if (count(explode(".", $column)) > 1) {
                $column = explode(".", $column)[0] . "." . explode(".", $column)[1];
            } else {
                $column = $column;
            }

            $this->query['select'] .= $column;
        }

        return $this;
    }

    /**
     * Method to generate the `WHERE` part of the query with group
     */
    public function whereGroup()
    {
        $param = func_get_args();
        $statusObject = ['object' => false, 'empty' => false];

        if (gettype($param[0]) == 'object') {
            $statusObject['object'] = true;

            if ($this->query['where'] == "") {
                $this->query['where'] = " WHERE ";
            } elseif ($this->query['where'] == " WHERE ") {
                $this->query['where'] .= "";
            } elseif (substr($this->query['where'], -1) == "(") {
                $this->query['where'] .= "";
            } else {
                $this->query['where'] .= " " . $param[1] . " ";
            }
            $this->query['where'] .= "(";
            $param[0]($this);
            $this->query['where'] .= ")";

            $karakter_terakhir = substr($this->query['where'], -7);
            $operator_karakter_terakhir = strpos($karakter_terakhir, $param[1]);

            if (strpos($karakter_terakhir, '()')) {
                $statusObject['empty'] = true;
                $this->query['where'] = explode($karakter_terakhir, $this->query['where'])[0];
            }
        }

        return $statusObject;
    }

    /**
     * Method to make the `WHERE` part of the query,
     * this method can generate the where query with or without `AND` operator
     * 
     * @return QueryBuilder
     */
    public function where()
    {
        $param = func_get_args();

        $whereGroup = $this->whereGroup($param[0], 'AND');

        if ($this->query['where'] == "") {
            $this->query['where'] = " WHERE ";
        } elseif ((gettype($param[0]) == 'object' && (substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (gettype($param[0]) != 'object' && substr($this->query['where'], -1) == "(") || ($whereGroup['object'] && $whereGroup['empty'])) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " AND ";
        }

        if (gettype($param[0]) != 'object') {
            $this->generateWhere($param);
        }

        return $this;
    }

    /**
     * Method to make the `WHERE` part of the query,
     * this method generate the where query with `OR` operator
     * 
     * @return QueryBuilder
     */
    public function orWhere()
    {
        $param = func_get_args();

        $this->whereGroup($param[0], 'OR');

        if ($this->query['where'] == "") {
            die("Cannot use 'OR' statement");
        } elseif ((gettype($param[0]) == 'object' && (substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (gettype($param[0]) != 'object' && substr($this->query['where'], -1) == "(")) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " OR ";
        }

        if (gettype($param[0]) != 'object') {
            $this->generateWhere($param);
        }

        return $this;
    }

    /**
     * Method to make the `ORDER BY` part of the query
     * 
     * @return QueryBuilder
     */
    public function orderBy(string $column, string $type = "ASC")
    {
        if ($this->query['orderBy'] == "") {
            $this->query['orderBy'] = " ORDER BY ";
        } else {
            $this->query['orderBy'] .= ", ";
        }

        if (count(explode(".", $column)) > 1) {
            $column = "" . explode(".", $column)[0] . "." . explode(".", $column)[1] . "";
        } else {
            $column = "" . $column . "";
        }

        $this->query['orderBy'] .= $column . " " . $type;

        return $this;
    }

    /**
     * Method to make the `LIMIT` and `OFFSET` part of the query
     * 
     * @return QueryBuilder
     */
    public function limit(int $limit, int $offset = 0)
    {
        $this->query['limit'] = " LIMIT ";
        $this->query['limit'] .= $limit;
        $this->query['limit'] .= " OFFSET " . $offset;

        return $this;
    }

    /**
     * Method to make the `JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    public function join(string $joinType, string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->query['join'] .= " $joinType JOIN ";
        $this->query['join'] .= "" . $table . " ON ";
        $onColumn = "" . explode(".", $onColumn)[0] . "." . explode(".", $onColumn)[1] . "";
        $onValue = "" . explode(".", $onValue)[0] . "." . explode(".", $onValue)[1] . "";
        $this->query['join'] .= $onColumn . " " . $onColumnOperator . " " . $onValue;

        return $this;
    }

    /**
     * Method to make the `GROUP BY` part of the query
     * 
     * @return QueryBuilder
     */
    public function groupBy(string $column)
    {
        $param = func_get_args();

        foreach ($param as $key => $value) {
            if ($this->query['groupBy'] == "") {
                $this->query['groupBy'] = " GROUP BY ";
            } else {
                $this->query['groupBy'] .= ", ";
            }

            if (count(explode(".", $value)) > 1) {
                $column = "" . explode(".", $value)[0] . "." . explode(".", $value)[1] . "";
            } else {
                $column = "" . $value . "";
            }

            $this->query['groupBy'] .= $column;
        }

        return $this;
    }

    /**
     * Method to combine each part of the query
     */
    public function generateSql()
    {
        if (!isset($this->table)) {
            echo "There is no <b>\$table</b> property in <b>" . get_class($this) . "</b>";
            die();
        }

        if (isset($this->table) && $this->table == '') {
            echo "The <b>\$table</b> property must be filled with Model table name in <b>" . get_class($this) . "</b>";
            die();
        }

        $this->query['table'] = "" . $this->table . "";

        $sql = 'SELECT ';
        $sql .= $this->query['select'] == '' ? "*" : "";
        $this->sql .= $sql;

        foreach ($this->query as $key => $value) {
            if ($key == 'table') {
                $this->sql .= " FROM ";
            }
            $this->sql .= $value;
        }
    }

    /**
     * Method to generate error message of the query
     */
    public function err_query($query, $indexErr = 2)
    {
        if (!$query) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            $file_location = '<br><b>' . $backtrace[$indexErr]['file'] . '</b> on line <b>' . $backtrace[$indexErr]['line'] . '</b>';
            echo '<br>' . mysqli_error($this->conn) . ' in ' . $file_location;
            die();
        }
    }

    /**
     * Method to add query string
     * 
     * @return Paginator
     */
    public function appends(array $datas)
    {
        $queryString = '';
        foreach ($datas as $key => $value) {
            $queryString .= $key > 0 ? '&' : '';
            $queryString .= $key . '=' . $value;
        }

        $this->queryString = $queryString;

        return $this;
    }
}
