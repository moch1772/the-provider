<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Referens.php';

$database = new Database();
$db = $database->connect();

$referens = new Referens($db);

$result = $referens->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $referens_arr = array();
    $referens_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $referens_item = array(
            'ID' => $ID,
            'referens' => $referens,
            'wikiID' => $wikiID
        );

        array_push($referens_arr['data'], $referens_item);
    }

    echo json_encode($referens_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
?>