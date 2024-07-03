<?php

class Database
{
    // DataBase Configuration
    private $host = "localhost";
    private $username = "u692177884_digitech";
    private $dbname = "u692177884_digitech";
    private $password = "VqWEP9|p";
    private $connection;

    // DataBase Connection
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            //throw $err;
            echo "Connection Error: " . $err->getMessage();
        }

        return $this->connection;
    }
}
