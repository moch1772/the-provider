<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once 'config/db.php';
    include_once 'includes/auth.php';
    
    $database = new Database();
    $db = $database->connect();

    $data = json_decode(file_get_contents("php://input"));

    $user = array(
        "ID" => $data->ID,
        "name" => $data->name,
        "lastname" => $data->lastname,
        "password" => $data->password
    );

    $auth = new Authenticator($db);

    $check = $auth->authenticateMod($user);

    echo $check;
?>