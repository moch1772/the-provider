<?php
include '../../config/db.php'; 
include_once '../../models/Moderator.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');


$database = new Database();
$db = $database->connect();

$ev = new Moderator($db);

$data = json_decode(file_get_contents("php://input"));

$ev->password = $data->password;
$ev->name = $data->name;


if($post->login()){
    echo json_encode(array('message' => 'Post Created'));
}else{
    echo json_encode(
        array('message'=>'Post Not created')
    );
}



?>