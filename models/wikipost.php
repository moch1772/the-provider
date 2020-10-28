<?php 
    include 'dbsetup.php';
?>
<?

    if(isset($_POST['submitwiki'])){
        $wikititle = $_POST['wikititle'];
        $wikitext = $_POST['wikitext'];
        $referens = $_POST['referens'];

        newArticle($wikititle, $wikitext, $referens, $conn);
    }
    function newArticle($wikititle, $wikitext, $referens, $conn) {
        if(!empty($wikititle) && !empty($wikitext) && !empty($referens)){

                $stmt = $conn->prepare("INSERT INTO wikiarticle (title, text) VALUES (?, ?)");
                $stmt->bind_param("ss", $wikititle, $wikitext);

                $stmt2 = $conn->prepare("INSERT INTO referens (referens) VALUES (?)");
                $stmt2->bind_param("si", $referens);
        
                $stmt->execute() && $stmt2->execute();
        
                echo "New article created successfully";
                
                $stmt->close();
                $conn->close(); 
        } else {
            echo "Make sure to fill in all fields";
        }
    }
?>