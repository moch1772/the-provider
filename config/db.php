<?php

class Database {

    private $host = 'http://te4-ntig.se';
    private $db = 'fedora';
    private $username = 'fedora@sko.te4-ntig.se';
    private $password = 'fedora123';
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