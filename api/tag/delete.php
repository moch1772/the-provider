<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Tag.php';

$database = new Database();
$db = $database->connect();

$tag = new Tag($db);

$tag->tagID = isset($_GET['tagID']) ? $_GET['tagID'] : die();

if($tag->remove()){
    echo json_encode(array('message' => 'Tag Removed'));
}else{
    echo json_encode(array('message' => 'Tag Not Removed'));
}

?>