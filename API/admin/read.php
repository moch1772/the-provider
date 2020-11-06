<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Blogghistory.php';

$database = new Database();
$db = $database->connect();

$blogghistory = new blogghistory($db);

$result = $blogghistory->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $blogghistory_arr = array();
    $blogghistory_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $blogghistory_item = array(
            'postID' => $postID,
            'userID' => $userID,
            'text' => html_entity_decode($text),
            'dateTime' => $dateTime,
        );

        array_push($blogghistory_arr['data'], $blogghistory_item);
    }

    echo json_encode($blogghistory_arr);

} else {
    echo json_encode(
        array('message' => 'No Blogghistory Found')
    );
}


?>