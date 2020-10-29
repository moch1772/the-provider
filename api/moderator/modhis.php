<?php
 
 include_once '../../config/db.php';
 include_once '../../models/Moderator.php';
 
 $database = new Database();
 $db = $database->connect();
 
 $his = new Moderator($db);
 
 $result = $his->modHistory();
 $rowCount = $result->rowCount();

 if($rowCount > 0){
    $his_arr = array();
    $his_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $his_item = array(
            'postID' => $postID,
            'commentID' => $commentID,
            'text' => html_entity_decode($text),
            'dateTime' => $dateTime,
            'userID' => $userID,
            'modID' => $modID
        );

        array_push($his_arr['data'], $his_item);
    }

    echo json_encode($his_arr);
}else {
        echo json_encode(
            array('message' => 'No Posts Found')
        );
        
    }

 /*function commenthistory($conn){

 $sql="SELECT * FROM commenthistory";
 $query = $conn->query($sql);    
        
         while($row = $query->fetch_assoc()){
            $text=$row['text'];
             $ID=$row['userID'];
             $modID=$row['modID'];

              $sql="SELECT name FROM user WHERE ID='$ID'"; 
              $qury = $conn->query($sql);
              $rew = $qury->fetch_assoc();
             

             $sql="SELECT name FROM user WHERE ID='$modID'"; 
             $qery = $conn->query($sql);
              $rw = $qery->fetch_assoc();

              echo $row['text'],$rw['name'],$rew['name'];
            
            
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
function modDelit($userID,$modNum,$commentID){
    date_default_timezone_set("Europe/Stockholm");
         $datum=date("Y-m-d h:i");

    if($modNum=1){
        
        $sql = "SELECT * FROM comment WHERE commentID='$commentID'";
        $qury = $conn->query($sql);
        $row = $qury->fetch_assoc();

        $com=$row['commentID'];
        $posterID=$row['userID'];
        $postID=$row['postID'];
        $text=$row['text'];


        $sql="INSERT INTO commenthistory(commentID,postID,userID,text,dateTime,modID) VALUES('$com','$postID','$posterID','$text','$datum','$userID')";

        $sql = "DELETE FROM comment WHERE commentID='$commentID'";
  $conn->query($sql);
    }else{
        
    }


}*/



?>