<?php 
    include 'dbsetup.php';
?>

<?php 
    $postID = $_GET['postID'];
    $tagID = $_GET['tagID'];
    $deleteTag = mysqli_query($conn, "DELETE FROM tag where tagID='$tagID'");

    if ($deleteTag)
    {
        mysqli_close($conn);
        header("location:editpost.php?postID=$postID");
        exit;
    } else {
        echo "Error deleting";
    }
?>