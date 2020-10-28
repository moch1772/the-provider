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
        WHERE c.postID = ?';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }

}


?>