<?php

class moderatorhistory {
    private $conn;
    private $table = 'moderatorhistory';

    public $ID;
    public $moderatorID;
    public $commentID;
    public $postID;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.ID, p.moderatorID, p.commentID, p.postID
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}
?>