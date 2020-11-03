<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Commenthistory.php';

$database = new Database();
$db = $database->connect();

$commenthistory = new commenthistory($db);

$result = $commenthistory->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $commenthistory_arr = array();
    $commenthistory_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $commenthistory_item = array(
            'commentID' => $commentID,
            'postID' => $postID,
            'userID' => $userID,
            'text' => html_entity_decode($text),
            'dateTime' => $dateTime,
            'modID' => $modID
        );

        array_push($commenthistory_arr['data'], $commenthistory_item);
    }

    echo json_encode($commenthistory_arr);

} else {
    echo json_encode(
        array('message' => 'No History Found')
    );
}


?>