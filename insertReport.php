<?php
$con=new Mysqli("localhost", "root", "", "provider");
$con->set_charset("utf8");

function insertReport($con, $postId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($postId))
    {
     $query=$con->prepare("insert into report (PostID, email, description) values(?, ?, ?)");
     $query->bind_param("iss", $postId, $email, $description);
     if($query->execute())      

     return TRUE;   
    }
}
function insertReportComment($con, $commentId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($postId))
    {
     $query=$con->prepare("insert into report (CommentID, email, description) values(?, ?, ?)");
     $query->bind_param("iss", $commentId, $email, $description);
     if($query->execute())      
     return TRUE;    
    }  
}
function insertReportStatus($con, $reportId , $status)
{
    if(isset($reportId))
    {
        echo $reportId .=" ";
        echo $status;
    $query=$con->prepare("update report set resolved=? where reportID=?");
    $query->bind_param("ii", $status, $reportId);
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
<form method="post"><input type="submit" name="submit" value="submit">
</form>
    <?php
    if(isset($_POST['submit']))
    {
    //$isInserted=insertReport($con, 1, $_POST['email'], $_POST['description']);
$isInserted=insertReportStatus($con, 5, 1);
    if($isInserted==TRUE)
    echo "true";
    else
    echo "false";
    }
    ?>
</body>
</html>