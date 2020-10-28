<?php

$con=new Mysqli("localhost", "root", "", "provider");
$con->set_charset("utf8");

function register($con)
{
    if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['submit']))
    {
        //hashing the password
        $password=$_POST['password'];
        $hash=password_hash($password, PASSWORD_DEFAULT);
$query=$con->prepare("insert into anvandare (anvNamn, losenord) values(?, ?)");
$query->bind_param("ss", $_POST['username'], $hash);
if($query->execute())
{
    echo "ditt konto har nu skapats. vänligen logga in </br>";
    echo "<a href='login.php'>logga in </a>";
    $query->close();
}
    }
}
register($con);
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
    <input type="text" name="username" placeholder="skriv in användarnamn">
    <input type="password" name="password" placeholder="skriv in lösenord">
    <input type="submit" name="submit" value="skapa konto">
    </form>
</body>
</html>