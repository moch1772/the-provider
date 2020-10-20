<?php 
    include 'dbsetup.php';
    session_start();
?>
<?php
/*if(!isset($_POST['submitpost'])) {
    $_POST['submitpost']="";
}*/
//$SHOW=$_POST['submitpost'];

    if(isset($_POST['submitpost'])){
        $bloggtitle = $_POST['bloggtitle'];
        $bloggtext = $_POST['bloggtext'];
        $showComments = $_POST['showComments'];
        newPost($bloggtitle, $bloggtext, $showComments, $_POST['submitpost'], $_POST['tag'], $conn);
    }
    function newPost($bloggtitle, $bloggtext, $showComments, $tagpost, $tag, $conn) {
        if ($tagpost=="Post") {
        if(!empty($bloggtitle) && !empty($bloggtext)){

                $stmt = $conn->prepare("INSERT INTO post (title, text, showComments) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $bloggtitle_p, $bloggtext_p, $showComments_p);
        
                $bloggtitle_p = $bloggtitle;
                $bloggtext_p = $bloggtext;
                $showComments_p = $showComments;
        
                $stmt->execute();
        
                echo "New records created successfully";
                
                $stmt->close();
                $conn->close();
        } else {
            echo "You must enter a title and content";
        }
    }

    if($tagpost=='tag'){
        if(isset($_SESSION['array'])) {
            $array = unserialize($_SESSION['array']);
            echo "hello";
        }
        else {
            $array = array();
        }
    //$auther = mysqli_query($conn, "INSERT INTO post (title, text, showComments) VALUES ('BACON', 'BACON',1)");
        if(!empty($tag)) {
            array_push($array, $tag);
        }
        $_SESSION['title']=$bloggtitle;
        $_SESSION['text']=$bloggtext;
        $_SESSION['array']=serialize($array);
    }
}
?>