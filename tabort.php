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
//det som är ovanför är bara för att ha något att visa
if(isset($_POST['anvnamn'])) {
   $anvNamn=$_POST['anvnamn'];

         $sql="SELECT ID FROM anvandare WHERE name='$anvNamn'";
         $query = $conn->query($sql);
          
         $row = $query->fetch_assoc();
         $anvID=$row['ID'];
         
          $sql="UPDATE rolls SET bloggmod=0 WHERE userID='$anvID'";
          $conn->query($sql);
       
}

   ?>