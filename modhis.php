<?php
$userID=$_SESSION['userID'];


 function commenthistory(){

    $conn = new mysqli('localhost', 'root','','provider');
    $conn->set_charset("utf8");
    if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     } 

 $sql="SELECT * FROM commenthistory";
 $query = $conn->query($sql);
        
         while($row = $query->fetch_assoc()){
             return $row['text'];

             $ID=$row['userID'];
             $modID=$row['modID'];

              $sql="SELECT name FROM user WHERE ID='$ID'"; 
              $qury = $conn->query($sql);
              $row = $qury->fetch_assoc();
              return $row['name'];

             $sql="SELECT name FROM user WHERE ID='$modID'"; 
             $query = $conn->query($sql);
              $row = $query->fetch_assoc();
              return $row['name'];
         }
 } 

 function modCheck($userID){
     
    $sql="SELECT * FROM moderator WHERE ID='$userID' AND bloggMod=1";
    $query = $conn->query($sql);
    $om = $query->fetch_assoc();

    if (!empty($om)){
        $_SESSION['modnum']=1;
    }else{
        $_SESSION['modnum']=0;
    }
 }


?>