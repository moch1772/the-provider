<?php
include '../../config/db.php'; 
include_once '../../models/Kalender.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new Kalender($db);



$new->id = isset($_GET['eventID']) ? $_GET['eventID'] : die();

 
 if($new->deleteALL_invite()){
    echo json_encode(array('message' => 'Invites deleted'));
}else{
    echo json_encode(
        array('message'=>'Invites Not deleted')
    );
}


?>