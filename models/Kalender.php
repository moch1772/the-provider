<?php
class Kalender{
    private $conn;
    private $table='event';

    public $eventID;
    public $userID;
    public $description;
    public $dateTime;
    //resiverID is the userID of the user that resives the invite
    public $resiverID;

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
        

        $sql="DELETE FROM invite WHERE eventID=?";

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

        return $stmt;

    }
    public function invite(){
        $sql ='SELECT * FROM invite WHERE eventID=:eventID AND resiverID=:resiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();

if (!empty()) {
    
        $sql = 'INSERT INTO invite SET eventID=:eventID, resiverID=:resiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();
}else{
        echo 'is alredy invited';
}
    }

    public function acceptInvite(){
        $sql = 'UPDATE invite SET accept=1 WHERE eventID=:eventID AND resiverID=:resiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();
    }

    public function deleteInvite(){
        $sql = 'DELETE FROM invite WHERE eventID=:eventID AND resiverID=:resiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();
    }

    public function deleteALL_invite(){
        $sql="DELETE FROM invite WHERE eventID=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    }

    public function readInvite(){
        $sql='SELECT * FROM invite WHERE resiverID=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;

    }
    
    



}

?>
