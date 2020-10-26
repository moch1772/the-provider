<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $postID,
            'title' => $title,
            'text' => html_entity_decode($text),
            'date' => $dateTime,
            'uid' => $userID,
            'showComments' => $showComments
        );

        array_push($post_arr['data'], $post_item);
    }

    echo json_encode($post_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}


?>