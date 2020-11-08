<?php
include '../../config/db.php'; 
include_once '../../models/image.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new image($db);



$new->id = isset($_GET['imageID']) ? $_GET['imageID'] : die();
 $new->deleteIMG();
 
echo 'k';


?>