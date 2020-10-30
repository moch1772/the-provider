<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Article.php';

$database = new Database();
$db = $database->connect();

$article = new Article($db);

$article->wikiID = isset($_GET['wikiID']) ? $_GET['wikiID'] : die();

$article->read_single();

$article_arr = array(
    'wikiID' => $article->wikiID,
    'title' => $article->title,
    'text' => html_entity_decode($article->text),
    'date' => $article->date,
    'userID' => $article->userID,
    'version' => $article->version
);

print_r(json_encode($article_arr));

?>