<?php
class Kalender{
    private $conn;
    private $table='event';

    public $eventID;
    public $userID;
    public $description;
    public $dateTime;
    //resiverID is the userID of the user that resives the invite
    public $receiverID;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createEvent(){
        $sql ='INSERT INTO event SET userID=:userID, description=:description, dateTime=:dateTime';

        $stmt = $this->conn->prepare($sql);
        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->dateTime = htmlspecialchars(strip_tags($this->dateTime));
        
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':dateTime', $this->dateTime);
       
        if($stmt->execute()){
            return true;
        }

        return false;
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

        if($stmt->execute()){
            return true;
        }

        
        return false;
    }

    public function updateEvent(){
        $sql="UPDATE event SET description=:description WHERE eventID=:eventID";

        $stmt = $this->conn->prepare($sql);
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));

        $stmt->bindParam(':description', $this->description); 
        $stmt->bindParam(':eventID', $this->eventID);

        if($stmt->execute()){
            return true;
        }

      
        return false;
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
      
        if($stmt->execute()){
            return true;
        }

        
        return false;

    }
    public function invite(){
        
        $sql = 'INSERT INTO invite SET eventID=:eventID, receiverID=:receiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->receiverID = htmlspecialchars(strip_tags($this->receiverID));

        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->bindParam(':receiverID', $this->receiverID);
        
        if($stmt->execute()){
            return true;
        }

       
        return false;

    }

    /*$sql = 'SELECT accept FROM invite WHERE eventID=:eventID AND resiverID=:resiverID';
    $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $Mod=$row['accept'];
        switch ($Mod) {
            case 0:
                $ac=1
                break;
            
            case 1:
                $ac=0
                break;
        }
        $sql = "UPDATE invite SET accept='$ac' WHERE eventID=:eventID AND resiverID=:resiverID";

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->resiverID = htmlspecialchars(strip_tags($this->resiverID));

        $stmt->bindParam(':resiverID', $this->resiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        $stmt->execute();*/
        

    public function acceptInvite(){
        $sql = 'UPDATE invite SET accept=1 WHERE eventID=:eventID AND receiverID=:receiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->receiverID = htmlspecialchars(strip_tags($this->receiverID));

        $stmt->bindParam(':receiverID', $this->receiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        if($stmt->execute()){
            return true;
        }

        
        return false;
    }
    public function declineInvite(){
        $sql = 'UPDATE invite SET accept=0 WHERE eventID=:eventID AND receiverID=:receiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->receiverID = htmlspecialchars(strip_tags($this->receiverID));

        $stmt->bindParam(':receiverID', $this->receiverID);
        $stmt->bindParam(':eventID', $this->eventID);
        

        if($stmt->execute()){
            return true;
        }

        return false;
    }
    

    public function deleteInvite(){
        $sql = 'DELETE FROM invite WHERE eventID=:eventID AND receiverID=:receiverID';

        $stmt = $this->conn->prepare($sql);
        $this->eventID = htmlspecialchars(strip_tags($this->eventID));
        $this->receiverID = htmlspecialchars(strip_tags($this->receiverID));

        $stmt->bindParam(':receiverID', $this->receiverID);
        $stmt->bindParam(':eventID', $this->eventID);
       

        if($stmt->execute()){
            return true;
        }

      
        return false;
    }
    

    public function deleteALL_invite(){
        $sql="DELETE FROM invite WHERE eventID=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()){
            return true;
        }

      
        return false;
    }

    public function readInvite(){
        $sql='SELECT * FROM invite WHERE receiverID=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;

    }
    
    



}

?>
