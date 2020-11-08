<?php
class image(){

    public function __construct($db) {
        $this->conn = $db;
    }
    public function insertImage(){
        $sql='INSERT INTO image SET location=:location,wikiID=:wikiID,postID=:postID';

        $stmt = $this->conn->prepare($sql);
      
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->bindParam(':postID', $this->postID);
        $stmt->bindParam(':location', $this->location);
        $stmt->execute();
    }
    public function deleteIMG(){
        $sql='DELETE FROM image WHERE imageID=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    }
    public function get_IMG(){
        $sql='SELECT * FROM image WHERE imageID=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;
    }

}



?>