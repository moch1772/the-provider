<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/db.php';
include_once '../../models/Article.php';

$database = new Database();
$db = $database->connect();

$article = new Article($db);

$article->wikiID = isset($_GET['wikiID']) ? $_GET['wikiID'] : die();

if($article->delete()) {
    echo json_encode(
        array('message' => 'Article deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Article not deleted')
    );
}
?>