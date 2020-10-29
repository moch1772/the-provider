<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');

include_once '../../config/db.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->postID = $data->postID;
$post->showComments = $data->showComments;
$post->text = $data->text;
$post->title = $data->title;

if($post->update()){
    echo json_encode(array('message' => 'Post Updated'));
}else{
    echo json_encode(
        array('message'=>'Post Not updated')
    );
}

