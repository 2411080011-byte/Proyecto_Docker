<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        $host = "db"; // o localhost según tu docker
        $dbname = "venta";
        $username = "Jesus16";
        $password = "jesus16";

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
