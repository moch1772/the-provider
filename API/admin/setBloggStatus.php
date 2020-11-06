<?php
include_once("../../config/db.php");
include_once("../../models/admin.php");
$db=new Database();
$conn = $db->connect();
$admin=new Admin($conn);

if(isset($_GET['status'])&&isset($_GET['bloggID']))
{
    $bloggId=$_GET['bloggID'];
    $status=$_GET['status'];
    echo $admin->setBloggStatus($bloggId, $status);
    
}



?>