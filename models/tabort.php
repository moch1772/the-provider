<?php
//$userID=$_SESSION['userID'];
include 'config/db.php';  



$sql = "SELECT ID FROM moderator WHERE bloggMod='1'";
   $all= $conn->query($sql);

      while ($row= $all->fetch_assoc()) {
          $av=$row['ID'];
        $sql="SELECT name FROM user WHERE ID='$av'";
        $aln= $conn->query($sql);
          while ($row= $aln->fetch_assoc()) {
             echo $row['name']; 
             $response=$row['name'];
             $json_response = json_encode($response);
             echo $json_response;
             echo '<form action="tabort.php" method="post">
             <input type="submit" name="anvnamn" value="'.$row["name"].'">
             </form>';
          }
       
   }

if(isset($_GET['anvnamn'])) {
   removeMod($_GET['anvnamn'],$conn);
}

//det som är ovanför är bara för att ha något att visa
function removeMod($anvName,$conn){


         $sql="SELECT ID FROM user WHERE name='$anvNamn'";
         $query = $conn->query($sql);
          
         $row = $query->fetch_assoc();
         $anvID=$row['ID'];
         
          $sql="UPDATE moderator SET bloggMod=0 WHERE ID='$anvID'";
          $conn->query($sql);

          $sql="DELETE FROM moderator WHERE bloggMod=0 AND wikiMod=0";
          $conn->query($sql);
       

}
/*function updateComent($comentID,userID,$newText){


   $sql="UPDATE comment SET text='$newText' WHERE commentID='$comentID' AND userID='$userID'";
   $conn->query($sql);

}*/



   ?>