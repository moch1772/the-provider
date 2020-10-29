<?php
class Moderator{
    private $conn;
    private $table='moderator';

    public $userID;
    

    public function __construct($db) {
        $this->conn = $db;
    }



    public function deleteBMod(){
     
          $sql="UPDATE moderator SET bloggMod=0 WHERE userID=?";

          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(1, $this->id);
          $stmt->execute();

          
          $sql="DELETE FROM moderator WHERE bloggMod=0 AND wikiMod=0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
    public function createBMod(){
        $sql = "SELECT bloggMod FROM moderator WHERE userID=?";
      
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $Mod=$row['bloggMod'];
        
        if (isset($Mod)){
            
           
switch ($Mod) {
    case '0':
        $sql="UPDATE moderator SET bloggMod=1 WHERE userID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        break;
    
    case '1':
        echo'är redan inloggad';
        break;
}
        
        }else{

       $sql="INSERT INTO moderator(userID,bloggMod) VALUES(?,1)";

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
     
        $sql="UPDATE moderator SET wikiMod=0 WHERE userID=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        
        $sql="DELETE FROM moderator WHERE bloggMod=0 AND wikiMod=0";

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
  }

  public function createWMod(){
      $sql = "SELECT wikiMod FROM moderator WHERE userID=?";
    
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

 $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $Mod=$row['wikiMod'];
      if (!empty($Mod)){
          
         
switch ($Mod) {
  case '0':
      $sql="UPDATE moderator SET wikiMod=1 WHERE userID=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      break;
  
  case '1':
      echo'är redan inloggad';
      break;
}
      
      }else{

     $sql="INSERT INTO moderator(userID,bloggMod) VALUES(?,1)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      }

      
      
  }
}
?>