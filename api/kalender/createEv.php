<?php
include '../../config/db.php'; 
include_once '../../models/Kalender.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');


$database = new Database();
$db = $database->connect();

$ev = new Kalender($db);

$data = json_decode(file_get_contents("php://input"));

$ev->userID = $data->userID;
$ev->description = $data->description;
$ev->dateTime = $data->dateTime;



echo 'ses';

$ev->createEvent();


?>
