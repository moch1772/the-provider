<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Referens.php';

$database = new Database();
$db = $database->connect();

$referens = new Referens($db);

$data = json_decode(file_get_contents('php://input'));

$referens->ID = $data->ID;

$referens->referens = $data->referens;
$referens->wikiID = $data->wikiID;

if($referens->update()) {
    echo json_encode(
        array('message' => 'Referens update')
    );
} else {
    echo json_encode(
        array('message' => 'Referens not updated')
    );
}
?>