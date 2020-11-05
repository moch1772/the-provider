<?php
include_once("../../config/db.php");
include_once("../../models/report.php");
$db=new Database();
$conn = $db->connect();
$report=new Report();

if(isset($_GET['commentId'])&&isset($_GET['email'])&&isset($_GET['description']))
{
    $commentId=$_GET['commentId'];
   $email=$_GET['email'];
   $description=$_GET['description'];
    $isInserted=$report->insertReportComment($conn, $commentId, $email, $description);
    echo $isInserted;
}



?>