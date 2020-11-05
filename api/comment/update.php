<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/db.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));

$comment->commentID = $data->commentID;
$comment->text = $data->text;

if($comment->update()){
    echo json_encode(array('message' => 'Comment Updated'));
}else{
    echo json_encode(array('message' => 'Comment Not Updated'));
}

?>