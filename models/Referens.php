<?php

class Referens{
    private $conn;
    private $table = 'referens';

    public $ID;
    public $referens;
    public $wikiID;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.ID, p.referens, p.wikiID
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.ID, p.referens, p.wikiID
        FROM '.$this->table. ' p
        WHERE p.ID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->referens = $row['referens'];
        $this->wikiID = $row['wikiID'];
        return $stmt;
    }

    public function create() {
        $sql = 'INSERT INTO ' . $this->table . ' SET referens = :referens,  wikiID= :wikiID';

        $stmt = $this->conn->prepare($sql);

        $this->referens = htmlspecialchars(strip_tags($this->referens));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));

        $stmt->bindParam(':referens', $this->referens);
        $stmt->bindParam(':wikiID', $this->wikiID);

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
            referens = :referens,
            wikiID = :wikiID
            WHERE 
            ID = :ID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->ID = htmlspecialchars(strip_tags($this->ID));
        $this->referens = htmlspecialchars(strip_tags($this->referens));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));

        //sätt data/Bind data
        $stmt->bindParam(':ID', $this->ID);
        $stmt->bindParam(':referens', $this->referens);
        $stmt->bindParam(':wikiID', $this->wikiID);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ID = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->ID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
}
?>