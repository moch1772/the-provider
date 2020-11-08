<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/image.php';

$database = new Database();
$db = $database->connect();

$article = new image($db);

$article->imageID = isset($_GET['imageID']) ? $_GET['imageID'] : die();

$article->get_IMG();

$article_arr = array(
    'wikiID' => $article->wikiID,
    'location' => $article->location,
    'imageID' => $article->imageID,
    'postID' => $article->postID
);

print_r(json_encode($article_arr));

?>