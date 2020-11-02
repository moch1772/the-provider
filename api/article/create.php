<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Article.php';

$database = new Database();
$db = $database->connect();

$article = new Article($db);

$data = json_decode(file_get_contents('php://input'));

$article->title = $data->title;
$article->text = $data->text;

if($article->create()) {
    echo json_encode(
        array('message' => 'Article created')
    );
} else {
    echo json_encode(
        array('message' => 'Article not created')
    );
}

?>