<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/search.php';

$database = new Database();
$db = $database->connect();

$post = new Search($db);
$post->search = isset($_GET['search']) ? $_GET['search'] : die();

$result = $post->read_Title();
$result = $post->read_Tag();
$rowCount = $result->rowCount();
$rowCOunt += $result2->rowCount();

if($rowCount > 0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'postID' => $postID,
            'title' => $title,
            'text' => html_entity_decode($text),
            'dateTime' => $dateTime,
            'userID' => $userID,
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