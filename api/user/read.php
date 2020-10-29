<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/db.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$result = $user->read();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $user_arr = array();
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $user_item = array(
            'ID' => $ID,
            'name' => $name,
            'lastname' => $lastname,
            'password' => $password
        );

        array_push($user_arr['data'], $user_item);
    }

    echo json_encode($user_arr);

} else {
    echo json_encode(
        array('message' => 'No Users Found')
    );
}


?>