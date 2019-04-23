<?php

class Database {
    private $db_host = 'localhost';
    private $db_name = 'myblog';
    private $db_user = 'apiuser';
    private $db_pass = '123456';
    private $conn;

    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host='. $this->db_host .';dbname='. $this->db_name, $this->db_user, $this->db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOExeption $e) {
            echo 'Error de conexion: '. $e->getMessage();
        }

        return $this->conn;
    
    }

}