<?php
include_once("config/db.php");

function insertReport($conn, $postId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($postId))
    {
     $query=$conn->prepare("insert into report (PostID, email, description) values(?, ?, ?)");
     $query->bind_param("iss", $postId, $email, $description);
     if($query->execute())      

     return TRUE;   
    }
}
function insertReportComment($conn, $commentId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($postId))
    {
     $query=$conn->prepare("insert into report (CommentID, email, description) values(?, ?, ?)");
     $query->bind_param("iss", $commentId, $email, $description);
     if($query->execute())      
     return TRUE;    
    }  
}
function insertReportStatus($conn, $reportId , $status)
{
    if(isset($reportId))
    {
        echo $reportId .=" ";
        echo $status;
    $query=$conn->prepare("update report set resolved=? where reportID=?");
    $query->bind_param("ii", $status, $reportId);
      if($query->execute())      
    return TRUE;    
   }
}

?>