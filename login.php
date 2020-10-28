<?php
session_start();

include 'config/db.php';

function userCheck($conn)
{
    {
        $password=$_POST['password'];
    $query=$conn->prepare("select anvNamn, losenord, anvId from anvandare where anvnamn=?");
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
userCheck($conn);
?>
