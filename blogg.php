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
        <input type="text" name="bloggtitle" placeholder="Title"></input><br></br>
        <textarea name="bloggtext" rows="20" cols="50" placeholder="Content"></textarea>
        <input type="submit" name="submitpost" value="Post"><br></br>
        <label for="comment">Tillåt kommentarer</label>
        <input type="hidden" name="showcomment" value="0"></input>
        <input type="checkbox" name="showcomment" value="1"></input>
    </form>

<table border="2">
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