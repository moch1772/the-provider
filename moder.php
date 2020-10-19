<?php

 
 

   echo'<form action="moder.php" method="post">
   <input type="text" name="anvendare" requierd>
   <input type="submit" name="submit">
   </form>';

   if(isset($_POST['submit'])){
   bloggMOD($_POST['anvendare']);
   }

function bloggMOD($anvNamn){

    $conn = new mysqli('localhost', 'root','','provider');
$conn->set_charset("utf8");

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
} 
   
   
?>