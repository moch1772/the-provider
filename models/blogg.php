<?php
    require 'bloggpost.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="bloggtitle" placeholder="Title"
        <?php
            if(isset($_SESSION['title'])) {
                echo "value=".$_SESSION['title'];
            }
        ?>
        ></input><br></br>
        <textarea name="bloggtext" rows="20" cols="50" placeholder="Content"><?php if(isset($_SESSION['text'])) {echo $_SESSION['text'];}?></textarea>
        <input type="submit" name="submitpost" value="Post"><br></br>
        <label for="comment">Tillåt kommentarer</label>
        <input type="hidden" name="showComments" value="0"></input>
        <input type="checkbox" name="showComments" value="1"></input>
        <input type="text" name="tag" placeholder="Add tag"></input>
        <input type="submit" name="submitpost" value="tag"></input>
        <!--<input type="submit" name="add-tag" value="Add tag"></input>-->
    </form>

    <table style= "width: 20%;" border="2";>
         <tr>
            <td>Tag</td>
            <td>Remove</td>
        </tr>

    <?php if(isset($_SESSION['array'])) {
        if(isset($_POST['submit2'])) {
            remove($_POST['submit2']);
        }
        $tags = unserialize($_SESSION['array']);
        foreach ($tags as $t) { 
    ?>
            <tr>
                <td><?php echo $t ?></td>
                <?php
                    echo'<td><form method="POST"><input type="submit" name="submit2" value='.$t.'></form></td>';
                ?>
            </tr>
    <?php 
        }
    }
    ?>
    </table>

<table style="position: fixed; margin-left: 50%; margin-top: -30%;" border="2">
  <tr>
    <td>postID</td>
    <td>anvID</td>
    <td>Title</td>
    <td>Text</td>
    <td>show Comment</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

<?php

include "dbsetup.php";

$result = mysqli_query($conn, "SELECT * FROM post");
while($row = mysqli_fetch_array($result))
{
?>
    <tr>
        <td><?php echo $row['postID']; ?></td>
        <td><?php echo $row['userID']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['text']; ?></td>
        <td><?php echo $row['showComments']; ?></td>
        <td><a href="editpost.php?postID=<?php echo $row['postID']; ?>">Edit</a></td>   
        <td><a href="deletepost.php?postID=<?php echo $row['postID']; ?>">Delete</a></td>
    </tr>	
<?php
        }
?>
</table>
</body>
</html>