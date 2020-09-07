<?php

class Database
{
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    private $db_host = DB_HOST;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            die($this->error);
        }
    }

    /**
     * 准备sql语句，创建$stmt
     *
     * @param [type] $sql
     * @return void
     */
    public function prepare($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * 绑定对应的值
     *
     * @param [type] $param
     * @param [type] $value
     * @param [type] $type
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch($value) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_string($value):
                    $type = PDO::PARAM_STR;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                default:
                    $type = PDO::PARAM_NULL;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        //改成PDO::FETCH_CLASS报错
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchOne()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function count()
    {
        return $this->stmt->rowCount();
    }
}