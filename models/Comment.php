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

    public function create(){
        $sql = 'INSERT INTO '.$this->table.'
        SET postID = :postID,
        userID = :userID,
        text = :text';

        $stmt = $this->conn->prepare($sql);

        $this->postID = htmlspecialchars(strip_tags($this->postID));
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->text = htmlspecialchars(strip_tags($this->text));

        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':text', $this->text);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);


        return false;
    }

    public function update(){
        $sql = 'UPDATE '.$this->table.'
        SET text = :text
        WHERE commentID = :commentID';

        $stmt = $this->conn->prepare($sql);

        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->commentID = htmlspecialchars(strip_tags($this->commentID));

        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':commentID', $this->commentID);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);


        return false;
    }

    public function remove(){
        $sql = 'DELETE FROM '.$this->table.'
        WHERE commentID = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->commentID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);


        return false;
    }

}


?>