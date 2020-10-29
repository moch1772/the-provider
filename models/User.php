<?php

class User{
    private $conn;
    private $table = 'user';

    public $ID;
    public $name;
    public $lastname;
    public $password;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        $sql = 'SELECT p.ID, p.name, p.lastname, p.password
        FROM '.$this->table. ' p';
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_single() {
        $sql = 'SELECT p.ID, p.name, p.lastname, p.password
        FROM '.$this->table. ' p
        WHERE p.ID = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID = $row['ID'];
        $this->name = $row['name'];
        $this->lastname = $row['lastname'];
        $this->password = $row['password'];
        
        return $stmt;
    }


    public function create(){
        //query
        $sql='INSERT INTO '.$this->table.'
        SET
            name= :name,
            lastname = :lastname,
            password = :password';
        
        $stmt = $this->conn->prepare($sql);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->password = htmlspecialchars(strip_tags($this->password));
        //Sätt/bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':password', $this->password);

        //execute
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    //Update User
    public function Update(){
        //Query
        $sql='UPDATE '.$this->table.'
        SET
            name = :name,
            lastname = :lastname,
            password = :password
            WHERE 
            ID = :ID';
        
        //Prepare
        $stmt = $this->conn->prepare($sql);

        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        //sätt data/Bind data
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':ID', $this->ID);
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete(){
        //Query
        $sql ='DELETE FROM '.$this->table .' WHERE ID= ?';

        //Prepare
        $stmt = $this->conn->prepare($sql);

        //sätt data/Bind data
        $stmt->bindParam(1, $this->ID);

        //Execute query
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }


}


?>