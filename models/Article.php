<?php

class Article{
    private $conn;
    private $table = 'wikiarticle';

    public $wikiID;
    public $userID;
    public $date;
    public $version;
    public $text;
    public $title;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.wikiID, p.userID, p.date, p.version, p.text, p.title
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.wikiID, p.userID, p.date, p.version, p.text, p.title
        FROM '.$this->table. ' p
        WHERE p.wikiID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->wikiID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->wikiID = $row['wikiID'];
        $this->userID = $row['userID'];
        $this->date = $row['date'];
        $this->version = $row['version'];
        $this->text = $row['text'];
        $this->title = $row['title'];
        
        return $stmt;
    }
    
    public function create() {
        $sql = 'INSERT INTO ' . $this->table . ' SET title = :title, text = :text, userID = :userID, version = :version';

        $stmt = $this->conn->prepare($sql);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->version = htmlspecialchars(strip_tags($this->version));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':version', $this->version);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
    
    //Update Article
    public function update(){
        //Query
        $sql='UPDATE '.$this->table.'
        SET
            text = :text,
            title = :title,
            userID = :userID,
            version = :version
            WHERE 
            wikiID = :wikiID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->text = htmlspecialchars(strip_tags($this->text));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));
        $this->version = htmlspecialchars(strip_tags($this->version));

        //sätt data/Bind data
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':version', $this->version);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE wikiID = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->wikiID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
}
?>