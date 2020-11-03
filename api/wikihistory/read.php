<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Wikihistory.php';

$database = new Database();
$db = $database->connect();

$wikihistory = new wikihistory($db);

$result = $wikihistory->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $wikihistory_arr = array();
    $wikihistory_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $wikihistory_item = array(
            'wikiID' => $wikiID,
            'text' => html_entity_decode($text),
            'userID' => $userID,
            'date' => $date
        );

        array_push($wikihistory_arr['data'], $wikihistory_item);
    }

    echo json_encode($wikihistory_arr);

} else {
    echo json_encode(
        array('message' => 'No Wikihistory Found')
    );
}


?>