<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Blogg.php';

$database = new Database();
$db = $database->connect();

$blogg = new Blogg($db);

$data = json_decode(file_get_contents('php://input'));

$blogg->name = $data->name;
$blogg->userID = $data->userID;
$blogg->hide = $data->hide;

if($blogg->create()) {
    echo json_encode(
        array('message' => 'Blogg created')
    );
} else {
    echo json_encode(
        array('message' => 'Blogg not created')
    );
}

?>