<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/search.php';

$database = new Database();
$db = $database->connect();

$post = new Search($db);
$post->search = isset($_GET['search']) ? $_GET['search'] : die();

$result = $post->read_TitleW();
$rowCount = $result->rowCount();


if($rowCount > 0){
    $post_arr = array();
    $post_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'wikiID' => $wikiID,
            'title' => $title,
            'text' => html_entity_decode($text),
            'date' => $dateTime,
            'userID' => $userID
        );

        array_push($post_arr['data'], $post_item);
    }
   

    //$post_arr['data']=array_map("unserialize", array_unique(array_map("serialize", $post_arr['data'])));
    echo json_encode($post_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}


?>