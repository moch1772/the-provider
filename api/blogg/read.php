<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Blogg.php';

$database = new Database();
$db = $database->connect();

$blogg = new Blogg($db);

$result = $blogg->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $blogg_arr = array();
    $blogg_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $blogg_item = array(
            'bloggID' => $bloggID,
            'name' => $name,
            'userID' => $userID,
            'hide' => $hide
        );

        array_push($blogg_arr['data'], $blogg_item);
    }

    echo json_encode($blogg_arr);

} else {
    echo json_encode(
        array('message' => 'No Bloggs Found')
    );
}


?>