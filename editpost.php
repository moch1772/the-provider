<?php 
    include 'dbsetup.php';
?>
<?php 
    $postID = $_GET['postID'];

    $query = mysqli_query($conn, "SELECT * FROM post where postID ='$postID'");

    $row = mysqli_fetch_assoc($query);

    if(isset($_POST['update'])) {

        $bloggtitle = $_POST['bloggtitle'];
        $bloggtext = $_POST['bloggtext'];
        $showcomment = $_POST['showcomment'];

        $edit = mysqli_query($conn,"UPDATE post set title='$bloggtitle', text='$bloggtext', showComments='$showcomment' where postID='$postID'");

        if($edit) {
            mysqli_close($conn);
            header("location:blogg.php");
            exit;
        } else {
            echo mysqli_error();
        }
    }
?>

<form action="" method="POST">
        <input type="text" name="bloggtitle" value="<?php echo $row['title'] ?>" placeholder="Title" Required><br></br>
        <textarea name="bloggtext" rows="20" cols="50" placeholder="Content"><?php echo $row['text'] ?></textarea>
        <input type="submit" name="update" value="Update"><br></br>
        <label for="comment">Tillåt kommentarer</label>
        <input type="hidden" name="showcomment" value="0"></input>
        <input type="checkbox" name="showcomment" value="<?php echo $row['showComments'];?>" 
        <?php 
        if($row['showComments']==1){
            echo"checked";}
        ?>
        >
</form>