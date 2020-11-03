<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Moderatorhistory.php';

$database = new Database();
$db = $database->connect();

$moderatorhistory = new moderatorhistory($db);

$result = $moderatorhistory->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $moderatorhistory_arr = array();
    $moderatorhistory_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $moderatorhistory_item = array(
            'ID' => $ID,
            'moderatorID' => $moderatorID,
            'commentID' => $commentID,
            'postID' => $postID
        );

        array_push($moderatorhistory_arr['data'], $moderatorhistory_item);
    }

    echo json_encode($moderatorhistory_arr);

} else {
    echo json_encode(
        array('message' => 'No Moderatorhistory Found')
    );
}


?>