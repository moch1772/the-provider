<?php
    $ID=$_GET['wikiID'];
    $reportID=$_GET['reportID'];

    $ch=curl_init();
    
    $url="http://localhost:8080/Projekt/Provider/the-provider/api/article/delete.php?wikiID=$ID";


    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    $url="http://localhost:8080/Projekt/Provider/the-provider/api/wikireport/resolvedTotrue.php?reportID=$reportID&status=1";
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);
    header('Location: control.php');