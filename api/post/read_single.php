<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->id = isset($_GET['postID']) ? $_GET['postID'] : die();

$post->read_single();

$post_arr = array(
    'postID' => $post->postID,
    'title' => $post->title,
    'text' => html_entity_decode($post->text),
    'dateTime' => $post->dateTime,
    'userID' => $post->userID,
    'showComments' => $post->showComments
);

print_r(json_encode($post_arr));
?>