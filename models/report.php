<?php    
header("Content-Type:application/json");
class Report
{
public function fetchReport($conn)
{
$query="select * from report";
    if($result=$conn->query($query))
    {
$array=array();
while($row=$result->fetch(PDO::FETCH_ASSOC))
{
  foreach($row as $i)
  $array[]=$i;
}
$json=json_encode($array);
      
    }
  return $json;  
}
public function insertReport($conn, $postId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($postId))
    {
     $query=$conn->prepare("insert into report (PostID, email, description) values(?, ?, ?)");
     
  
     if($query->execute([$postId, $email, $description]))      

     return TRUE;   
    }
}
public function insertReportComment($conn, $commentId, $email, $description)
{
    if(isset($email)&&isset($description)&&isset($commentId))
    {
     $query=$conn->prepare("insert into report (commentID, email, description) values(?, ?, ?)");
     if($query->execute([$commentId, $email, $description]))      
     return TRUE;    
     else
     {
       return FALSE;
     }
    }  
}
public function insertReportStatus($conn, $reportId, $status)
{
    if(isset($reportId))
    {
        $query=$conn->prepare("update report set resolved=? where reportID=?");
      if($query->execute([$reportId, $status]))      
2    return TRUE;        
  }
}
public function getReport($conn, $reportId)
{
  $query="select * from report where reportID=$reportId";
  if($result=$conn->query($query))
  {
$array=array();
while($row=$result->fetch(PDO::FETCH_ASSOC))
{
foreach($row as $i)
$array[]=$i;
}
$json=json_encode($array);
    
  }
return $json;  

}


}

?>