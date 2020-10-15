<?php
$dbhost = 'localhost';
$user = 'root';
$pass = '';
$db = 'provider';

$conn = mysqli_connect("$dbhost", "$user", "$pass", "$db");


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>