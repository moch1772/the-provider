<?php 
    include 'dbsetup.php';
    $postID = $_GET['postID'];
    if(isset($_POST['submittag'])) {
    if($_POST['submittag']=="Add tag") {
        $sql = "INSERT INTO tag(postID, tag) VALUE($postID, '".$_POST['tag']."')";
        mysqli_query($conn, $sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    $query = mysqli_query($conn, "SELECT * FROM post where postID ='$postID'");

    $row = mysqli_fetch_assoc($query);

    if(isset($_POST['update'])) {

        $bloggtitle = $_POST['bloggtitle'];
        $bloggtext = $_POST['bloggtext'];
        $showComments = $_POST['showComments'];

        $edit = mysqli_query($conn,"UPDATE post set title='$bloggtitle', text='$bloggtext', showComments='$showComments' where postID='$postID'");

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
        <input type="text" name="bloggtitle" value="<?php echo $row['title']; ?>" placeholder="Title" Required><br></br>
        <textarea name="bloggtext" rows="20" cols="50" placeholder="Content"><?php echo $row['text']; ?></textarea>
        <input type="submit" name="update" value="Update"><br></br>
        <label for="Showcomments">Tillåt kommentarer</label>
        <input type="hidden" name="showComments" value="0"></input>
        <input type="checkbox" name="showComments" value="<?php echo $row['showComments']; ?>">
        <input type="text" name="tag" placeholder="Add tag"></input>
        <input type="submit" name="submittag" value="Add tag"></input>
</form>

<table style border="2">
    <tr>
        <td>Tag</td>
        <td>Delete</td>
    </tr>
    
<?php

$tagresult = mysqli_query($conn, "SELECT * FROM tag where postID='$postID'");
while($tagrow = mysqli_fetch_array($tagresult))
{
?>
     <tr>
        <td><?php echo $tagrow['tag']; ?></td>   
        <td><a href="deletetag.php?tagID=<?php echo $tagrow['tagID']; ?>&postID=<?php echo $postID?>">Delete</a></td>
    </tr>
<?php 
    }
?>
</body>
</html>