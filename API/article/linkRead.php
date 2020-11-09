<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Article.php';

$database = new Database();
$db = $database->connect();

$article = new Article($db);

$article->wikiID = isset($_GET['wikiID']) ? $_GET['wikiID'] : die();

$pp= html_entity_decode($article->titleLink());
echo $pp;
 json_encode($pp);


?>
