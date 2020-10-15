<?php
    require '../bloggpost.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/css.css">
    <title>Document</title>
</head>
<body>

    


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

include "../dbsetup.php";
$search=$_POST['search'];
$result = mysqli_query($conn, "SELECT * FROM post where title like '%$search%'");
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
    $search=$_POST['search'];
    $tags = mysqli_query($conn, "SELECT postID FROM tag where tag='$search'");
    while($rows = mysqli_fetch_array($tags))
    {   
        $result = mysqli_query($conn, "SELECT * FROM post where postID=".$rows['postID']."");
        while($row = mysqli_fetch_array($result))
        {?>
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
    }
?>
</table>
<a href="search.html">BACK</a>



