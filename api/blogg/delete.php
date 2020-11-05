<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/testdbconn.php';
include_once '../../models/Blogg.php';

$database = new Database();
$db = $database->connect();

$blogg = new Blogg($db);

$blogg->bloggID = isset($_GET['bloggID']) ? $_GET['bloggID'] : die();

if($blogg->delete()) {
    echo json_encode(
        array('message' => 'Article deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Article not deleted')
    );
}
?>