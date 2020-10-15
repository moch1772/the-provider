<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/css.css">
    <title>Document</title>
</head>
<body>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $studentbase = "provider";
    
    // Skapa kopling till server
    $mysqli = new mysqli($servername,$username,$password,$studentbase);

    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $search=


    $sql="select * from post where title='$search' "
    $post= $mysqli->query($sql);
    while($row = $post->fetch_assoc()){
        
    }*/
?>



