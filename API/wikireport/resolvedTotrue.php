<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/db.php';
include_once '../../models/Wikireport.php';

$database = new Database();
$db = $database->connect();

$wikireport = new Wikireport($db);

if(isset($_GET['reportID'])&&isset($_GET['status']))
{
    $reportId=$_GET['reportID'];
    $status=$_GET['status'];
    $isInserted=$wikireport->resolvedToTrue($db, $reportId);
echo $isInserted;
}
?>