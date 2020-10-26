<?php
session_start();
$con=new Mysqli("localhost", "root", "", "provider");
$con->set_charset("utf8");

function userCheck($con)
{
if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['submit']))
{
    $password=$_POST['password'];
 $query=$con->prepare("select anvNamn, losenord, anvId from anvandare where anvnamn=?");
 $query->bind_param("s", $_POST['username']);
 $query->execute();
 $result=$query->get_result();
 if($result->num_rows>0)
 {

$row=$result->fetch_row();

if(password_verify($password, $row[1]))
{
    $userId=$row[2];
$_SESSION['userId']=$userId;
header("location: index.php");
}
else
echo "lösenordet är felaktigt. vänligen försök igen";
 }
 else
 echo "fel användarnamn.  Vänligen försök igen";
}
}
userCheck($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
<input type="text" name="username" placeholder="användarnamn">
<input type="password" name="password" placeholder="lösenord">
<input type="submit" name="submit" value="logga in">
</body>
</html>