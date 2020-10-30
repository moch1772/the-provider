<?php
class Kalender{
    private $conn;
    private $table='event';

    public $eventID;
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
       
       
        echo 'sås';
    }
    public function deleteEvent(){
        $sql="DELETE FROM event WHERE eventID=?";


        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    }
    public function updateEvent(){
        $sql="UPDATE event SET description=:description WHERE eventID=:eventID";

        $stmt = $this->conn->prepare($sql);
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));

        $stmt->bindParam(':description', $this->description); 
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();
    }
    public function readEvent(){
        $sql='SELECT * FROM '.$this->table.'';



        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;

    }
    public function userEvent(){
        $sql='SELECT * FROM '.$this->table.' WHERE userID=?';

        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);

        /*while($row > 0){

        $this->eventID = $row['eventID'];
        $this->description = $row['description'];
        $this->userID = $row['userID'];
        $this->dateTime = $row['dateTime']; 
        
        
        }*/
       return $stmt;

    }

}

?>
