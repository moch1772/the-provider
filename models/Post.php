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
    }

    public function create(){
        //query
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
        $this->bloggID = htmlspecialchars(strip_tags($this->bloggID));
        $this->hidden = htmlspecialchars(strip_tags($this->hidden));
        //Sätt/bind data
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':showComments', $this->showComments);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':bloggID', $this->bloggID);
        $stmt->bindParam(':hidden', $this->hidden);

        //execute
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    //Update Post
    public function Update(){
        //Query
        $sql='UPDATE '.$this->table.'
        SET
            showComments= :showComments,
            text = :text,
            title = :title,
            hidden = :hidden
            WHERE 
            postID = :postID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->showComments = htmlspecialchars(strip_tags($this->showComments));
        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->postID = htmlspecialchars(strip_tags($this->postID));

        //sätt data/Bind data
        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':showComments', $this->showComments);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':hidden', $this->hidden);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {

        //Query
        $sql = 'SELECT * FROM '.$this->table.' WHERE postID=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->postID);
        $stmt->execute();
        return $stmt;

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $postID=$row['postID'];
        $userID=$row['userID'];
        $dateTime=$row['dateTime'];
        $showComments=$row['showComments'];
        $text=$row['text'];
        $title=$row['title'];
        $bloggID=$row['bloggID'];
        $hidden=$row['hidden'];

        $sql = "INSERT INTO blogghistory SET postID='$postID',userID='$userID',dateTime='$dateTime',showComments='$showComments',text='$text',title='$title',bloggID='$bloggID',hidden='$hidden'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $sql ='DELETE FROM '.$this->table .' WHERE postID= ?';

        //Prepare
        $stmt = $this->conn->prepare($sql);

        //sätt data/Bind data
        $stmt->bindParam(1, $this->postID);

        //Execute query
        if($stmt->execute()){
            echo $sql;
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }


    public function create(){
        //query
        $sql='INSERT INTO '.$this->table.'
        SET
            userID = :userID,
            showComments= :showComments,
            text = :text,
            bloggID = :bloggID,
            hidden = :hidden
            title = :title';
        
        $stmt = $this->conn->prepare($sql);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->showComments = htmlspecialchars(strip_tags($this->showComments));
        $this->text = htmlspecialchars($this->text);
        $this->title = htmlspecialchars($this->title);
        $this->bloggID = htmlspecialchars(strip_tags($this->bloggID));
        $this->hidden = htmlspecialchars(strip_tags($this->hidden));
        //Sätt/bind data
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':showComments', $this->showComments);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':bloggID', $this->bloggID);
        $stmt->bindParam(':hidden', $this->hidden);

        //execute
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

      //Update Post
      public function Update(){
        //Query
        $sql='UPDATE '.$this->table.'
        SET
            showComments= :showComments,
            text = :text,
            title = :title,
            bloggID = :bloggID,
            hidden = :hidden
            WHERE 
            postID = :postID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->showComments = htmlspecialchars(strip_tags($this->showComments));
        $this->text = htmlspecialchars($this->text);
        $this->title = htmlspecialchars($this->title);
        $this->postID = htmlspecialchars(strip_tags($this->postID));
        $this->bloggID = htmlspecialchars(strip_tags($this->bloggID));
        $this->hidden = htmlspecialchars(strip_tags($this->hidden));

        //sätt data/Bind data
        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':showComments', $this->showComments);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':hidden', $this->hidden);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {

        //Query
        $sql = 'SELECT * FROM '.$this->table.' WHERE postID=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->postID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $postID=$row['postID'];
        $userID=$row['userID'];
        $dateTime=$row['dateTime'];
        $showComments=$row['showComments'];
        $text=$row['text'];
        $title=$row['title'];
        $bloggID=$row['bloggID'];
        $hidden=$row['hidden'];

        $sql = "INSERT INTO blogghistory SET postID='$postID',userID='$userID',dateTime='$dateTime',showComments='$showComments',text='$text',title='$title',bloggID='$bloggID',hidden='$hidden'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $sql ='DELETE FROM '.$this->table .' WHERE postID= ?';

        //Prepare
        $stmt = $this->conn->prepare($sql);

        //sätt data/Bind data
        $stmt->bindParam(1, $this->postID);

        //Execute query
        if($stmt->execute()){
            echo $sql;
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

}

?>