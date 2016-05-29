<?php

class Database {
    private $host = "localhost";
    private $db_name = "c87Aiisystem";
    private $username = "c87aiisystem";
    private $password = "5pm#B0laALgGH";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        } catch(PDOException $err) {
            echo "Connection error: {$err->getMessage()}";
        }
        return $this->conn;
    }
}