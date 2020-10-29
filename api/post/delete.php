<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->postID = isset($_GET['postID']) ? $_GET['postID'] : die();





if($post->delete()){
    echo json_encode(array('message' => 'Post Delete'));
}else{
    echo json_encode(
        array('message'=>'Post Not delete')
    );
}

