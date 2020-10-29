<?php
//$userID=$_SESSION['userID'];
include '../../config/db.php'; 
include_once '../../models/Moderator.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new Moderator($db);



$new->id = isset($_GET['userID']) ? $_GET['userID'] : die();
 $new->deleteBMod();
 
echo 'k';


//det som är ovanför är bara för att ha något att visa
/*function removeMod($anvName,$conn){


         $sql="SELECT ID FROM user WHERE name='$anvNamn'";
         $query = $conn->query($sql);
          
         $row = $query->fetch_assoc();
         $anvID=$row['ID'];
         
          $sql="UPDATE moderator SET bloggMod=0 WHERE ID='$anvID'";
          $conn->query($sql);

          $sql="DELETE FROM moderator WHERE bloggMod=0 AND wikiMod=0";
          $conn->query($sql);
       

}
function updateComent($comentID,userID,$newText){


   $sql="UPDATE comment SET text='$newText' WHERE commentID='$comentID' AND userID='$userID'";
   $conn->query($sql);

}*/



   ?>