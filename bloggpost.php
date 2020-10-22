<?php 
    include 'dbsetup.php';
?>
<?php
$bloggtitle = "";
$update = false;

    if(isset($_POST['submitpost'])){
        $bloggtitle = $_POST['bloggtitle'];
        $bloggtext = $_POST['bloggtext'];
        $showcomment = $_POST['showcomment'];
        newPost($bloggtitle, $bloggtext, $showcomment, $conn);
    } 

    function newPost($bloggtitle, $bloggtext, $showcomment, $conn) {

        if(!empty($bloggtitle) && !empty($bloggtext)){

                $stmt = $conn->prepare("INSERT INTO post (title, text, showComments) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $bloggtitle_p, $bloggtext_p, $showcomment_p);
        
                $bloggtitle_p = $bloggtitle;
                $bloggtext_p = $bloggtext;
                $showcomment_p = $showcomment;
        
                $stmt->execute();
        
                echo "New records created successfully";
                
                $stmt->close();
                $conn->close();
        } else {
            echo "You must enter a title and content";
        }
    }
?>