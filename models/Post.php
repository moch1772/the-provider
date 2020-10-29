<?php

class Post{
    private $conn;
    private $table = 'post';

    public $postID;
    public $userID;
    public $dateTime;
    public $showComments;
    public $text;
    public $title;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title
        FROM '.$this->table. ' p
        WHERE p.postID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->postID = $row['postID'];
        $this->userID = $row['userID'];
        $this->dateTime = $row['dateTime'];
        $this->showComments = $row['showComments'];
        $this->text = $row['text'];
        $this->title = $row['title'];
        
        return $stmt;
    }


    public function create(){
        $sql='INSERT INTO '.$this->table.'
        SET
            userID = :userID,
            showComments= :showComments,
            text = :text,
            title = :title';
        
        $stmt = $this->conn->prepare($sql);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->showComments = htmlspecialchars(strip_tags($this->showComments));
        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->title = htmlspecialchars(strip_tags($this->title));

        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':showComments', $this->showComments);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }


}


?>