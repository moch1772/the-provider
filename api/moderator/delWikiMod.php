<?php
include '../../config/db.php'; 
include_once '../../models/Moderator.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');


$database = new Database();
$db = $database->connect();

$new = new Moderator($db);



$data = json_decode(file_get_contents("php://input"));

$new->userID = $data->userID;
$new->wikiID = $data->wikiID;

 
 
 if($new->deleteWMod()){
    echo json_encode(array('message' => 'Moderator deleted'));
}else{
    echo json_encode(
        array('message'=>'Moderator Not deleted')
    );
}



?>
