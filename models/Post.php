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
    public $bloggID;
    public $hidden;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title, p.bloggID, p.hidden
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title, p.bloggID, p.hidden
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
        $this->bloggID = $row['bloggID'];
        $this->hidden = $row['hidden'];
        
        return $stmt;
    }

    public function read_public() {
        $sql = 'SELECT p.postID, p.userID, p.dateTime, p.showComments, p.text, p.title, p.bloggID, p.hidden
        FROM '.$this->table. ' p
        WHERE p.hidden = 0';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

}

?>