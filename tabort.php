<?php

$conn = new mysqli('localhost', 'root','','provider');
$conn->set_charset("utf8");
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }  



$sql = "SELECT userID FROM rolls WHERE bloggmod='1'";
   $all= $conn->query($sql);

      while ($row= $all->fetch_assoc()) {
          $av=$row['anvID'];
        $sql="SELECT name FROM user WHERE ID='$av'";
        $aln= $conn->query($sql);
          while ($row= $aln->fetch_assoc()) {
             echo $row['anvNamn']; 
             echo '<form action="tabort.php" method="post">
             <input type="submit" name="anvnamn" value="'.$row["anvNamn"].'">
             </form>';
          }
       
   }

if(isset($_POST['anvnamn'])) {
   removeMod($_POST['anvnamn']);
}

//det som är ovanför är bara för att ha något att visa
function removeMod($anvName){


         $sql="SELECT ID FROM user WHERE name='$anvNamn'";
         $query = $conn->query($sql);
          
         $row = $query->fetch_assoc();
         $anvID=$row['ID'];
         
          $sql="UPDATE moderator SET bloggMod=0 WHERE ID='$anvID'";
          $conn->query($sql);

          $sql="DELETE FROM moderator WHERE bloggMod=0 AND wikiMod=0";
          $conn->query($sql);
       

}


   ?>