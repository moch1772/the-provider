<?php
include '../../config/db.php'; 
include_once '../../models/Kalender.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new Kalender($db);


$new->id = isset($_GET['userID']) ? $_GET['userID'] : die();

$result=$new->userEvent();
$rowCount = $result->rowCount();

if ($rowCount > 1) {
    $new_arr = array();
    $new_arr['data']=array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

 $new_item = array(
    'eventID' => $eventID,
    'description' => $description,
    'userID' => $userID,
    'dateTime' => $dateTime
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
/* $result = 
$rowCount = $result->rowCount();
if ($rowCount > 0) {
    $new_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

 $new_item = array(
    'eventID' => $eventID,
    'description' => $description,
    'userID' => $userID,
    'dateTime' => $dateTime
);
array_push($new_arr['data'],$new_item);

    }
echo json_encode($new_arr);
}*/



?>