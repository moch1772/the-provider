<?php 
    include 'dbsetup.php';
?>

<?php 
    $postID = $_GET['postID'];

    $delete = mysqli_query($conn, "DELETE FROM post where postID ='$postID'");
    $deleteTag = mysqli_query($conn, "DELETE FROM  tag where postID='$postID'");

    if ($delete and $deleteTag)
    {
        mysqli_close($conn);
        header("location:blogg.php");
        exit;
    } else {
        echo "Error deleting";
    }
?>