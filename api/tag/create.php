<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');

include_once '../../config/db.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$data = json_decode(file_get_contents("php://input"));

$tag->postID = $data->postID;
$tag->tag = $data->tag;

if($tag->create()){
    echo json_encode(array('message' => 'Tag Created'));
}else{
    echo json_encode(
        array('message'=>'Tag Not created')
    );
}

