<?php

class Blogg{
    private $conn;
    private $table = 'blogg';

    public $bloggID;
    public $name;
    public $userID;
    public $hide;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.bloggID, p.name, p.userID, p.hide
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.bloggID, p.name, p.userID, p.hide
        FROM '.$this->table. ' p
        WHERE p.bloggID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->bloggID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->bloggID = $row['bloggID'];
        $this->name = $row['name'];
        $this->userID = $row['userID'];
        $this->hide = $row['hide'];
        
        return $stmt;
    }
    
    public function create() {
        $sql = 'INSERT INTO ' . $this->table . ' SET name = :name, userID = :userID, hide = :hide';

        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars($this->name);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->hide = htmlspecialchars(strip_tags($this->hide));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':hide', $this->hide);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
    
    //Update Blogg
    public function update(){
        //Query
        $sql='UPDATE '.$this->table.'
        SET
            name = :name,
            userID = :userID,
            hide = :hide
            WHERE 
            bloggID = :bloggID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->bloggID = htmlspecialchars(strip_tags($this->bloggID));
        $this->name = htmlspecialchars($this->name);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->hide = htmlspecialchars(strip_tags($this->hide));

        //sätt data/Bind data
        $stmt->bindParam(':bloggID', $this->bloggID);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':hide', $this->hide);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE bloggID = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->bloggID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
    public function read_public() {
        $sql = 'SELECT p.bloggID, p.name, p.userID, p.hide
        FROM '.$this->table. ' p
        WHERE p.hide = 0';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
?>