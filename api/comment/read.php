<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$comment = new Post($db);

$comment->id = isset($_GET['postID']) ? $_GET['postID'] : die();

$comment->read_single();

$post_arr = array(
    'commentID' => $comment->commentID,
    'postID' => $comment->postID,
    'userID' => $comment->userID,
    'text' => $comment->html_entity_decode($comment->text),
    'dateTime' => $comment->dateTime
);

print_r(json_encode($post_arr));

?>