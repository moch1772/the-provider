<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Referens.php';

$database = new Database();
$db = $database->connect();

$referens = new Referens($db);

$referens->ID = isset($_GET['ID']) ? $_GET['ID'] : die();

if($referens->delete()) {
    echo json_encode(
        array('message' => 'Reference deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Reference not deleted')
    );
}
?>