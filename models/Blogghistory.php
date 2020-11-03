<?php

class blogghistory {
    private $conn;
    private $table = 'blogghistory';

    public $postID;
    public $userID;
    public $dateTime;
    public $text;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.text
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}
?>