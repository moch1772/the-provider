<?php    
header("Content-Type:application/json");
include_once("config/db.php");

function fetchReport($conn)
{
$query="select * from report";
    if($result=$con->query($query))
    {
$array=array();
while($row=$result->fetch_assoc())
{
  foreach($row as $i)
  $array[]=$i;
}
$json=json_encode($array);
    
    
    }
    else
    echo $con->error;
  return $json;  
}
if(isset($_GET['insertReport'])&&strlen($_GET['insertReport'])>0)
{
$str=fetchReport($conn);
echo $str;
}
?>