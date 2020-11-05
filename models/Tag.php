<?php

class Tag{
    private $conn;
    private $table = 'tag';

    public $tagID;
    public $postID;
    public $tag;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT tagID, postID, tag 
        FROM '.$this->table;
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function remove(){
        $sql = 'DELETE FROM '.$this->table.'
        WHERE tagID = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->tagID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function create(){
        $sql='INSERT INTO '.$this->table.'
        SET
            postID = :postID,
            tag = :tag';
        
        $stmt = $this->conn->prepare($sql);
        $this->postID = htmlspecialchars(strip_tags($this->postID));
        $this->tag = htmlspecialchars(strip_tags($this->tag));

        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':tag', $this->tag);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }
}

?>