<?php
    require 'wikipost.php';
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
        <input type="text" name="wikititle" placeholder="Title"></input><br></br>
        <textarea name="wikitext" rows="20" cols="50" placeholder="Content"></textarea><br></br>
        <textarea name="referens" rows="10" cols="30" placeholder="Reference"></textarea>
        <input type="submit" name="submitwiki" value="Post"><br></br>

    </form>

<table style="position: fixed; margin-left: 50%; margin-top: -30%;" border="2">
  <tr>
    <td>wikiID</td>
    <td>anvID</td>
    <td>Title</td>
    <td>Text</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

<?php

include "dbsetup.php";

$result = mysqli_query($conn, "SELECT * FROM wikiarticle");
while($row = mysqli_fetch_array($result))
{
?>
    <tr>
        <td><?php echo $row['wikiID']; ?></td>
        <td><?php echo $row['userID']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['text']; ?></td>
        <td><a href="editwiki.php?wikiID=<?php echo $row['wikiID']; ?>">Edit</a></td>   
        <td><a href="deletewiki.php?wikiID=<?php echo $row['wikiID']; ?>">Delete</a></td>
    </tr>	
<?php
        }
?>
</table>
</body>
</html>