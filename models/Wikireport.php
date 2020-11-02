<?php

class Wikireport{
    private $conn;
    private $table = 'wikireport';

    public $reportID;
    public $description;
    public $userID;
    public $email;
    public $date;
    public $wikiID;
    public $resolved;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.reportID, p.description, p.userID, p.email, p.date, p.wikiID, p.resolved
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.reportID, p.description, p.userID, p.email, p.date, p.wikiID, p.resolved
        FROM '.$this->table. ' p
        WHERE p.reportID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->reportID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->reportID = $row['reportID'];
        $this->description = $row['description'];
        $this->userID = $row['userID'];
        $this->email = $row['email'];
        $this->date = $row['date'];
        $this->wikiID = $row['wikiID'];
        $this->resolved = $row['resolved'];
        
        return $stmt;
    }

    public function create() {
        $sql = 'INSERT INTO ' . $this->table . ' SET description = :description, userID = :userID, email = :email, wikiID = :wikiID, resolved = :resolved';

        $stmt = $this->conn->prepare($sql);

        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));
        $this->resolved = htmlspecialchars(strip_tags($this->resolved));

        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->bindParam(':resolved', $this->resolved);

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
            description = :description,
            userID = :userID,
            email = :email,
            wikiID = :wikiID,
            resolved = :resolved
            WHERE 
            reportID = :reportID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->reportID = htmlspecialchars(strip_tags($this->reportID));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->wikiID = htmlspecialchars(strip_tags($this->wikiID));
        $this->resolved = htmlspecialchars(strip_tags($this->resolved));

        //sätt data/Bind data
        $stmt->bindParam(':reportID', $this->reportID);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->bindParam(':resolved', $this->resolved);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete() {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE reportID = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $this->reportID);
        
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s /n", $stmt->error);

        return false;
    }
}
?>