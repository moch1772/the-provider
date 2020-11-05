<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Article.php';

$database = new Database();
$db = $database->connect();

$article = new Article($db);

$result = $article->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $article_arr = array();
    $article_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $article_item = array(
            'wikiID' => $wikiID,
            'title' => $title,
            'text' => html_entity_decode($text),
            'date' => $date,
            'userID' => $userID,
            'version' => $version
        );

        array_push($article_arr['data'], $article_item);
    }

    echo json_encode($article_arr);

} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}


?>