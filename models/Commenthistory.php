<?php

class commenthistory {
    private $conn;
    private $table = 'commenthistory';

    public $commentID;
    public $postID;
    public $userID;
    public $text;
    public $dateTime;
    public $modID;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.commentID, p.postID, p.userID, p.text, p.dateTime, p.modID
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}
?>