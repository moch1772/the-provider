<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "provider";

    //$conn = new mysqli($servername, $username, $password, $db);
    $conn = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $username, $password);

    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    define('APP_NAME', 'Provider');

?>