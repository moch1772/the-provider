<?php

class Comment{
    private $conn;
    private $table = 'comment';

    public $commentID;
    public $postID;
    public $userID;
    public $text;
    public $dateTime;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT c.commentID, c.postID, c.userID, c.text, c.dateTime
        FROM '.$this->table. ' c
        WHERE p.postID = ?';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}


?>