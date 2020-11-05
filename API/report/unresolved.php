<?php    
header("Content-Type:application/json");
include_once("../../config/db.php");
include_once("../../models/report.php");
$db=new Database();
$conn = $db->connect();
$report=new Report();
echo $report->fetchUnresolved($conn);

?>