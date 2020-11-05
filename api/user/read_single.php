<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$user->id = isset($_GET['ID']) ? $_GET['ID'] : die();

$user->read_single();

$user_arr = array(
    'ID' => $user->ID,
    'name' => $user->name,
    'lastname' => $user->lastname,
    'password' => $user->password,
);

print_r(json_encode($user_arr));

?>