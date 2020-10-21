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
    $sql3="show tables";
    $tabel = $mysqli->query($sql3);
    while($rowd = $tabel->fetch_assoc()){
    echo"<table>";
    echo"<caption>".$rowd['Tables_in_'.$studentbase]."</caption>";
    $sql2="describe ".$rowd['Tables_in_'.$studentbase];
    $fields = $mysqli->query($sql2);
    while($row = $fields->fetch_assoc()) {
        echo "<th>".$row['Field']."</th>";
    }
    $sql="select * from ".$rowd['Tables_in_'.$studentbase];
    $inlagg= $mysqli->query($sql);
    while($row = $inlagg->fetch_assoc()){
        echo"<tr>";
        $fields = $mysqli->query($sql2);
        while($rows = $fields->fetch_assoc()) {
            echo"
            <td>".$row[$rows['Field']]."</td>
            ";
        }
        echo"</tr>";
    }
    echo"</table>";
    echo"</br>";
    }
    
?>




