<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Comment.php';

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$comment->postID = isset($_GET['postID']) ? $_GET['postID'] : die();

$result = $comment->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $comment_arr = array();
    $comment_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $comment_item = array(
            'commentID' => $commentID,
            'postID' => $postID,
            'userID' => $userID,
            'text' => html_entity_decode($text),
            'dateTime' => $dateTime
        );

        array_push($comment_arr['data'], $comment_item);
    }

    echo json_encode($comment_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}


?>