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





?>