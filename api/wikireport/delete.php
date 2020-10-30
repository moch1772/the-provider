<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Wikireport.php';

$database = new Database();
$db = $database->connect();

$wikireport = new Wikireport($db);

$wikireport->reportID = isset($_GET['reportID']) ? $_GET['reportID'] : die();

if($wikireport->delete()) {
    echo json_encode(
        array('message' => 'Wikireport deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Wikireport not deleted')
    );
}
?>