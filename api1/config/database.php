<?php

class database
{
    private $host = 'localhost';
    private $dbname  = 'api1';
    private $userName = 'root';
    private $password = 'zxc,./';

    public function connexionDB()
    {
        $db = null;
        try {

            $db  = new PDO("mysql:host=$this->host; utf8=true; dbname=$this->dbname", $this->userName, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            // echo 'connection';
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $db;
    }
}
