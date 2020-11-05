<?php
class Moderator{
    private $conn;
    private $table='moderator';

    public $userID;
    

    public function __construct($db) {
        $this->conn = $db;
    }



    public function deleteBMod(){
     
          $sql="UPDATE moderator SET bloggID=0 WHERE userID=?";

          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(1, $this->id);
          $stmt->execute();

          
          $sql="DELETE FROM moderator WHERE bloggID=0 AND wikiID=0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
    public function createBMod(){
        $sql = "SELECT bloggID FROM moderator WHERE userID=?";
      
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $Mod=$row['bloggID'];
        
        if (isset($Mod)){
            
           
switch ($Mod) {
    case '0':
        $sql="UPDATE moderator SET bloggID= WHERE userID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        break;
    
    case '1':
        echo'är redan inloggad';
        break;
}
        
        }else{

       $sql="INSERT INTO moderator(userID,bloggID) VALUES(?,1)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        }

        
        
    }
      
        
    public function modHistory(){
        $sql="SELECT * FROM commenthistory";



        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;

    }

    public function deleteWMod(){
     
        $sql="UPDATE moderator SET wikiID=0 WHERE userID=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        
        $sql="DELETE FROM moderator WHERE bloggID=0 AND wikiID=0";

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
  }

  public function createWMod(){
      $sql = "SELECT wikiID FROM moderator WHERE userID=?";
    
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

 $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $Mod=$row['wikiID'];
      if (!empty($Mod)){
          
         
switch ($Mod) {
  case '0':
      $sql="UPDATE moderator SET wikiID=1 WHERE userID=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      break;
  
  case '1':
      echo'är redan inloggad';
      break;
}
      
      }else{

     $sql="INSERT INTO moderator(userID,wikiID) VALUES(?,1)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      }

      
      
  }
  public function login(){
      $sql = 'SELECT * FROM user WHERE name=:name AND password=:password';
      $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $ID = $row['ID'];
        $name = $row['name'];
        if(!empty($ID)){
            $sql="SELECT bloggID FROM blogg WHERE userID='$ID'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $bloggID = $row['bloggID'];
            if (!empty($bloggID)) {
                return $bloggID;
                
            }
            $sql="SELECT bloggID,wikiID FROM moderator WHERE userID='$ID'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $bri = $row['bloggID'];
            $wiki = wikiID['wikiID'];
            if (!empty($bri)) {
                return $bloggID;
            }
            if (!empty($wiki)) {
                return $wiki;
            }
            return $name;
            }else {
                echo 'no';
            }

        }


  
}
?>