<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Blogg.php';

$database = new Database();
$db = $database->connect();

$blogg = new Blogg($db);

$blogg->bloggID = isset($_GET['bloggID']) ? $_GET['bloggID'] : die();

$blogg->read_single();

$blogg_arr = array(
    'bloggID' => $blogg->bloggID,
    'name' => $blogg->name,
    'userID' => $blogg->userID,
    'hide' => $blogg->hide
);

print_r(json_encode($blogg_arr));

?>