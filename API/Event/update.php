<?php
include '../../config/db.php'; 
include_once '../../models/Kalender.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');


$database = new Database();
$db = $database->connect();

$ev = new Kalender($db);

$data = json_decode(file_get_contents("php://input"));

$ev->eventID = $data->eventID;
$ev->description = $data->description;







if($ev->updateEvent()){
    echo json_encode(array('message' => 'Event updated'));
}else{
    echo json_encode(
        array('message'=>'Event not updated')
    );
}
?>