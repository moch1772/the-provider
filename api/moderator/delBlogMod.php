<?php

include '../../config/db.php'; 
include_once '../../models/Moderator.php';


header('Access-Control-Allow-Origin: *');
 
header('Content-Type:application/json');

$database = new Database();
$db = $database->connect();

$new = new Moderator($db);



$new->id = isset($_GET['userID']) ? $_GET['userID'] : die();
 $new->deleteBMod();

echo 'k';


   ?>