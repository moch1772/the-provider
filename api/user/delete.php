<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$user->ID = isset($_GET['ID']) ? $_GET['ID'] : die();





if($user->delete()){
    echo json_encode(array('message' => 'user Delete'));
}else{
    echo json_encode(
        array('message'=>'user Not delete')
    );
}

