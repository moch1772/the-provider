<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Referens.php';

$database = new Database();
$db = $database->connect();

$referens = new Referens($db);

$data = json_decode(file_get_contents('php://input'));

$referens->referens = $data->referens;
$referens->wikiID = $data->wikiID;

if($referens->create()) {
    echo json_encode(
        array('message' => 'Reference created')
    );
} else {
    echo json_encode(
        array('message' => 'Reference not created')
    );
}

?>