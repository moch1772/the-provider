<?php
include_once("../../config/db.php");
include_once("../../models/report.php");
$db=new Database();
$conn = $db->connect();
$report=new Report();

if(isset($_GET['reportId'])&&isset($_GET['status']))
{
    $reportId=$_GET['reportId'];
    $status=$_GET['status'];
    $isInserted=$report->insertReportStatus($conn, $reportId, $status);
echo $isInserted;
}
?>