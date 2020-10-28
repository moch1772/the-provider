<?php

class Database {

    private $host = 'localhost';
    private $db = 'provider';
    private $username = 'root';
    private $password = '';
    private $conn; 

    public function connect(){
        $this->conn = null;


        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $error) {
            echo 'Connection Error: '. $error->getMessage();
        }

        return $this->conn;
    }

}



?>