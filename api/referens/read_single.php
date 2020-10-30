<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/testdbconn.php';
include_once '../../models/Referens.php';

$database = new Database();
$db = $database->connect();

$referens = new Referens($db);

$referens->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

$referens->read_single();

$referens_arr = array(
    'ID' => $referens->ID,
    'referens' => $referens->referens,
    'wikiID' => $referens->wikiID
);

print_r(json_encode($referens_arr));

?>