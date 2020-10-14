<?php
$con=new Mysqli("localhost", "root", "", "provider");
$con->set_charset("utf8");

function insertReport($con, $email, $description, $postId)
{
    if(isset($email)&&isset($description))
    {
     $query=$con->prepare("insert into report (PostID, email, beskrivning) values(?, ?, ?)");
     $query->bind_param("iss", $postId, $email, $description);
     if($query->execute())      
     return TRUE;   
     
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
    <form method="post">
    <input type="text" name="email" placeholder="vänligen skriv in din mail" required>
    <input type="text" name="description" placeholder=" vänligen skriv en kort beskrivning om problemet">
    <input type="submit" name="submit" value="submit">
    </form>
    <?php
    if(isset($_POST['submit']))
    {
    $isInserted=insertReport($con, 1, $_POST['email'], $_POST['description']);
    if($isInserted==TRUE)
    echo "true";
    else
    echo "false";
    }
    ?>
</body>
</html>