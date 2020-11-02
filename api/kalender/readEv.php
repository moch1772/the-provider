<?php
 
 include_once '../../config/db.php';
 include_once '../../models/Kalender.php';
 
 $database = new Database();
 $db = $database->connect();
 
 $his = new Kalender($db);
 
 $result = $his->readEvent();
 $rowCount = $result->rowCount();

 if($rowCount > 0){
    $his_arr = array();
    $his_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $his_item = array(
            'eventID' => $eventID,
            'description' => $description,
            'userID' => $userID,
            'dateTime' => $dateTime
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