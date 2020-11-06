<?php
class Moderator{
    private $conn;
    private $table='moderator';

    public $userID;
    

    public function __construct($db) {
        $this->conn = $db;
    }



    public function deleteBMod(){
     
          $sql="UPDATE moderator SET bloggID=0 WHERE userID=:userID AND bloggID=:bloggID";

          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(':userID', $this->userID);
          $stmt->bindParam(':bloggID', $this->bloggID);
          $stmt->execute();

          
          $sql="DELETE FROM moderator WHERE bloggID=0 AND wikiID=0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }
    public function createBMod(){
        
       $sql="INSERT INTO moderator(userID,bloggID) VALUES(:userID,:bloggID)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':bloggID', $this->bloggID);
        $stmt->execute();
        
    }
      
        
    public function modHistory(){
        $sql="SELECT * FROM commenthistory";



        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;

    }

    public function deleteWMod(){
     
        $sql="UPDATE moderator SET wikiID=0 WHERE userID=:userID AND wikiID=:wikiID";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':wikiID', $this->wikiID);
        $stmt->execute();

        
        $sql="DELETE FROM moderator WHERE bloggID=0 AND wikiID=0";

      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
  }

  public function createWMod(){
     

     $sql="INSERT INTO moderator(userID,wikiID) VALUES(:userID,:wikiID)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':userID', $this->userID);
      $stmt->bindParam(':wikiID', $this->wikiID);
      $stmt->execute();
      

      
      
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
            $sql="SELECT bloggID FROM moderator WHERE userID='$ID'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $bri = $row['bloggID'];

            if (!empty($bri)) {
                return $bloggID;
            }
            
            return $name;
            }else {
                echo 'no';
            }
            

        }
     public function loginwiki(){
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
                      $sql="SELECT wikiID FROM moderator WHERE userID='$ID'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $wiki = $row['wikiID'];

                if (!empty($wiki)) {
                    return $wiki;
                }
            }else {
                echo 'no';
            }
                
            }

  
}
?>