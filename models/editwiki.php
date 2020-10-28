<?php 
    include 'dbsetup.php';
    $wikiID = $_GET['wikiID'];
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
    $query = mysqli_query($conn, "SELECT * FROM wikiarticle where wikiID ='$wikiID'");

    $row = mysqli_fetch_assoc($query);

    if(isset($_POST['updatewiki'])) {

        $wikititle = $_POST['wikititle'];
        $wikitext = $_POST['wikitext'];

        $edit = mysqli_query($conn,"UPDATE wikiarticle set title='$wikititle' text='$wikitext' where wikiID='$wikiID'");

        if($edit) {
            mysqli_close($conn);
            header("location:wikiarticle.php");
            exit;
        } else {
            echo mysqli_error($link);
        }
    }
?>

<form action="" method="POST">
        <input type="text" name="wikititle" value="<?php echo $row['title']; ?>" placeholder="Title" Required><br></br>
        <textarea name="wikitext" rows="20" cols="50" placeholder="Content"><?php echo $row['text']; ?></textarea>
        <input type="submit" name="updatewiki" value="Update"><br></br>
</form>
</body>
</html>