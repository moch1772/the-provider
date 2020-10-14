<?php

$conn = new mysqli('localhost', 'root','','provider');
$conn->set_charset("utf8");
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }  



$sql = "SELECT anvID FROM rolls WHERE bloggmod='1'";
   $all= $conn->query($sql);

      while ($row= $all->fetch_assoc()) {
          $av=$row['anvID'];
        $sql="SELECT anvNamn FROM anvandare WHERE anvID='$av'";
        $all= $conn->query($sql);
          while ($row= $all->fetch_assoc()) {
             echo $row['anvNamn']; 
             echo '<form action="tabort.php" method="post">
             <input type="submit" value="'.$row["anvNamn"].'">
             </form>';
          }
       
   }
?>