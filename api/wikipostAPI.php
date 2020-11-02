<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');
    
    include "dbsetup.php";

    function newArticle($wikititle, $wikitext, $referens, $conn) {
        if(!empty($wikititle) && !empty($wikitext) && !empty($referens)){

            $stmt = $conn->prepare("INSERT INTO wikiarticle (title, text) VALUES (?, ?)");
            $stmt->bind_param("ss", $wikititle, $wikitext);
        
            $stmt->execute();
                
            $stmt->close();
            $conn->close();
        }
    }
?>