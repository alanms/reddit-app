<?php

class DatabaseConnector {

    private $db_connection = null;

    public function __construct()
    {
        /*
         * normally a .env file is created to handle it
         */
        $host = 'localhost';
        $port = 3306;
        $db   = 'reddit';
        $user = 'root';
        $pass = '';

        try {
            $this->db_connection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db_connection;
    }
}