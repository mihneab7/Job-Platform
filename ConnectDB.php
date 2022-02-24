<?php

class ConnectDB
{
    private static $instance = null;
    private $conn;

    private $host = '127.0.0.1';
    private $user = 'root';
    private $password = 'Flanco2021';
    private $name = 'hr';

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host}; dbname={$this->name}",
                        $this->user, $this->password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}