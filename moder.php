<?php

$conn = new mysqli('localhost', 'root','','provider');
$conn->set_charset("utf8");
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }  
 $bloggMod=1;

   echo'<form action="moder.php" method="post">
   <input type="text" name="anvendare">
   <input type="submit" name="submit">
   </form>';

   if(isset($_POST['submit'])){
   $anvNamn=$_POST['anvendare'];

   $sql="SELECT anvID FROM anvandare WHERE anvNamn='$anvNamn'";
   $query = $conn->query($sql);
    
   $resultat = $query->fetch_assoc();
   if (!empty($resultat)) {
    $resultt = $conn->query($sql);
    $row = $resultt->fetch_assoc();
        $anvID=$row['anvID'];
        echo $anvID;
        $sql = "SELECT bloggmod FROM rolls WHERE anvID='$anvID'";
        $query = $conn->query($sql);
        $om = $query->fetch_assoc();
        if (!empty($om)){
            $mod = $conn->query($sql);
            $row = $mod->fetch_assoc();

        $Mod=$row['bloggmod'];
switch ($Mod) {
    case '0':
        $sql="UPDATE rolls SET bloggmod='$bloggMod' WHERE anvID='$anvID'";
        $conn->query($sql);
        break;
    
    case '1':
        echo'är redan inloggad';
        break;
}
        
        }else{

       $sql="INSERT INTO rolls(anvID,bloggmod) VALUES('$anvID','$bloggMod')";
       $conn->query($sql);
        }
}
   }
?>