<?php


$conn = new mysqli('localhost', 'root','','provider');
$conn->set_charset("utf8");
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 } 
 
 $sql="SELECT * FROM commenthistory";
 $query = $conn->query($sql);
        
         while($row = $query->fetch_assoc()){
             echo $row['text'];

             $userID=$row['userID'];
             $modID=$row['modID'];

              $sql="SELECT name FROM user WHERE ID='$userID'"; 
              $qury = $conn->query($sql);
              $row = $qury->fetch_assoc();
              echo $row['name'];

             $sql="SELECT name FROM user WHERE ID='$modID'"; 
             $query = $conn->query($sql);
              $row = $query->fetch_assoc();
              echo $row['name'];
         }
         



?>