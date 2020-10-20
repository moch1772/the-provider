<?php 
require '../bloggpost.php';
include 'function.php';
include "../dbsetup.php";

$text=searchTitle($_POST['search'],'title',$conn);
foreach($text as $i){
    echo $i;
    echo "<br>";
}

?>
<br>
<a href="searchFuntiontest.html";>TILLBAKA</a>