<?php

class wikihistory {
    private $conn;
    private $table = 'wikihistory';

    public $wikiID;
    public $text;
    public $userID;
    public $date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.wikiID, p.text, p.userID, p.date
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}
?>