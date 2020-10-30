<?php
class Kalender{
    private $conn;
    private $table='event';

    public $userID;
    public $description;
    public $dateTime;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createEvent(){
        $sql ="INSERT INTO event SET userID=:userID, description=:description, dateTime=:dateTime";

        $stmt = $this->conn->prepare($sql);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->dateTime = htmlspecialchars(strip_tags($this->dateTime));
        
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':dateTime', $this->dateTime);
       
        $stmt->execute();
        echo 'sås';
    }
    public function deleteEvent(){
        $sql="DELETE FROM event WHERE eventID=?";


        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    }

}

?>
