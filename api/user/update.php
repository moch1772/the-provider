<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');

include_once '../../config/db.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new user($db);

$data = json_decode(file_get_contents("php://input"));

$user->ID = $data->ID;
$user->name = $data->name;
$user->lastname = $data->lastname;
$user->password = $data->password;

if($user->update()){
    echo json_encode(array('message' => "user updated"));
}else{
    echo json_encode(
        array('message'=>'user Not updated')
    );
}

