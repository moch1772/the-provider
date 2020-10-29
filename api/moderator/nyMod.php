<?php
header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');
 
include_once '../../config/db.php';
include_once '../../models/Moderator.php';

$database = new Database();
$db = $database->connect();

$new = new Moderator($db);



$new->id = isset($_GET['userID']) ? $_GET['userID'] : die();
 $new->createBMod();
echo 'ok';







   /*if(isset($_GET[''])&& strlen($_GET['nomore']) >0){
   bloggMOD($_GET['nomore'],$conn);
   }

function bloggMOD($anvNamn,$conn){

   

 $bloggMod=1;
 
   $sql="SELECT ID FROM user WHERE name='$anvNamn'";
   $query = $conn->query($sql);

   $resultat = $query->fetch_assoc();
   if (!empty($resultat)) {
    $resultt = $conn->query($sql);
    $row = $resultt->fetch_assoc();
        $anvID=$row['ID'];
       

        $sql = "SELECT bloggmod FROM moderator WHERE ID='$anvID'";
        $query = $conn->query($sql);
        $om = $query->fetch_assoc();

        if (!empty($om)){
            $mod = $conn->query($sql);
            $row = $mod->fetch_assoc();

        $Mod=$row['bloggmod'];
switch ($Mod) {
    case '0':
        $sql="UPDATE moderator SET bloggMod='$bloggMod' WHERE ID='$anvID'";
        $conn->query($sql);
        break;
    
    case '1':
        echo'är redan inloggad';
        break;
}
        
        }else{

       $sql="INSERT INTO moderator(ID,bloggmod) VALUES('$anvID','$bloggMod')";
       $conn->query($sql);
        }
}
} */
   
   
?>