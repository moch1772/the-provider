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
                //$conn->close();
        } else {
            echo "You must enter a title and content";
        }
        $array = unserialize($_SESSION['array']);
        if(!empty($array)) {
            $sql = "SELECT postID FROM post where text='$bloggtext' AND title='$bloggtitle'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                foreach($array as $fullsend) {
                    $commando = "INSERT INTO tag(postID, tag) VALUES ('".$row["postID"]."', '$fullsend')";
                    $confirm = mysqli_query($conn, $commando);
                }
            }
        }
        session_destroy();
    }

    if($tagpost=='tag'){
        if(isset($_SESSION['array'])) {
            $array = unserialize($_SESSION['array']);
        }
        else {
            $array = array();
        }
    //$auther = mysqli_query($conn, "INSERT INTO post (title, text, showComments) VALUES ('BACON', 'BACON',1)");
        if(strlen($tag)>0) {
            array_push($array, $tag);
        }
        $_SESSION['title']=$bloggtitle;
        $_SESSION['text']=$bloggtext;
        $_SESSION['array']=serialize($array);
    }
}
function remove($remove) {
    $array = unserialize($_SESSION['array']);
    $key = array_search($remove, $array);
    unset($array[$key]);
    $_SESSION['array']=serialize($array);
}

function deleteTag($deleteTag) {
    
    mysqli_query($conn, "DELETE FROM tag where postID='$postID'");
}
?>