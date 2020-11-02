<?php 
    include 'dbsetup.php';
?>

<?php 
    $wikiID = $_GET['wikiID'];

    $delete = mysqli_query($conn, "DELETE FROM wikiarticle where wikiID ='$wikiID'");

    if ($delete)
    {
        mysqli_close($conn);
        header("location:wikiarticle.php");
        exit;
    } else {
        echo "Error deleting";
    }
?>