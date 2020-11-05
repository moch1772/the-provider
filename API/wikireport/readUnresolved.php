<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Wikireport.php';

$database = new Database();
$db = $database->connect();

$wikireport = new Wikireport($db);

$result = $wikireport->readUnresolved();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $wikireport_arr = array();
    $wikireport_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $wikireport_item = array(
            'reportID' => $reportID,
            'description' => $description,
            'userID' => $userID,
            'email' => $email,
            'date' => $date,
            'wikiID' => $wikiID,
            'resolved' => $resolved
        );

        array_push($wikireport_arr['data'], $wikireport_item);
    }

    echo json_encode($wikireport_arr);

} else {
    echo json_encode(
        array('message' => 'No Wikireports Found')
    );
}


?>