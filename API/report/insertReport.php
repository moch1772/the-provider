<?php
include_once("../../config/db.php");
include_once("../../models/report.php");
$db=new Database();
$conn = $db->connect();
$report=new Report();

if(isset($_GET['postId'])&&isset($_GET['email'])&&isset($_GET['description']))
{
    $postId=$_GET['postId'];
   $email=$_GET['email'];
   $description=$_GET['description'];
    $isInserted=$report->insertReport($conn, $postId, $email, $description);
echo $isInserted;
}
?>