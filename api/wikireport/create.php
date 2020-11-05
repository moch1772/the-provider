<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/db.php';
include_once '../../models/Wikireport.php';

$database = new Database();
$db = $database->connect();

$wikireport = new Wikireport($db);

$data = json_decode(file_get_contents('php://input'));

$wikireport->description = $data->description;
$wikireport->userID = $data->userID;
$wikireport->email = $data->email;
$wikireport->wikiID = $data->wikiID;
$wikireport->resolved = $data->resolved;

if($wikireport->create()) {
    echo json_encode(
        array('message' => 'Report submitted')
    );
} else {
    echo json_encode(
        array('message' => 'Report not submitted')
    );
}

?>