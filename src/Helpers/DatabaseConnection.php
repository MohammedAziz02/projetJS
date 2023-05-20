<?php

namespace gestionclub\Helpers;

use PDO;
use PDOException;


class DatabaseConnection {
    private static $instance = null;
    private $conn=null;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "gestion_club";

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->name", $this->user, $this->pass);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

}
