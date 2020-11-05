<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/Wikireport.php';

$database = new Database();
$db = $database->connect();

$wikireport = new Wikireport($db);

$wikireport->reportID = isset($_GET['reportID']) ? $_GET['reportID'] : die();

$wikireport->read_single();

$wikireport_arr = array(
    'reportID' => $wikireport->reportID,
    'description' => $wikireport->description,
    'userID' => $wikireport->userID,
    'email' => $wikireport->email,
    'date' => $wikireport->date,
    'wikiID' => $wikireport->wikiID,
    'resolved' => $wikireport->resolved
);

print_r(json_encode($wikireport_arr));

?>