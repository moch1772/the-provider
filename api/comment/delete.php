<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$comment->commentID = isset($_GET['commentID']) ? $_GET['commentID'] : die();

if($comment->remove()){
    echo json_encode(array('message' => 'Comment Removed'));
}else{
    echo json_encode(array('message' => 'Comment Not Removed'));
}

?>