<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <?php
    $ID=$_GET['postID'];
    ?>
<form id="form" action="update.php?postID='<?php $ID ?>'" method="POST">
<?php
    $post=$_GET['postID'];
    $post_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/post/read_single.php?postID='.$post.'';
    $post_JSON=file_get_contents($post_URL);
    $post_array=json_decode($post_JSON,true);
    echo "<input type='text' name='title' value='".$post_array['title']."'></input><br>";
    echo '<textarea rows="2" cols="5" name="text" form="form">'.$post_array['text'].'</textarea>';
?>

</form>