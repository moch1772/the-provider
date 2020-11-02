<?php

include "dbsetup.php";

function newRefrence($text, $wikiID, $conn){

    $stmt = $conn->prepare("INSERT INTO referens (referens, wikiID) VALUES (?, ?)");
    $stmt->bind_param("si", $text, $wikiID);

    $stmt->execute();

}

?>