<?php
include '../../config/db.php'; 
include_once '../../models/Kalender.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new Kalender($db);


$new->id = isset($_GET['eventID']) ? $_GET['eventID'] : die();

$result=$new->readIvite();
$rowCount = $result->rowCount();

if ($rowCount > 0) {
    $new_arr = array();
    $new_arr['data']=array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

 $new_item = array(
    'eventID' => $eventID,
    'resiverID' => $resiverID,
    'accept' => $accept
);
array_push($new_arr['data'],$new_item);

    }
 json_encode($new_arr);
}else{
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}



print_r(json_encode($new_arr));
?>