<?php
include '../../config/db.php'; 
include_once '../../models/image.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requseted-With');


$database = new Database();
$db = $database->connect();

$new = new image($db);


$data = json_decode(file_get_contents("php://input"));

$new->postID = $data->postID;
$new->wikiID = $data->wikiID;
$new->location = $data->location;


 $new->insertImage();
 
echo 'k';
?>