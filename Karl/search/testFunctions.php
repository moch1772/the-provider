<?php 
//require '../../bloggpost.php';
include 'function/search.php';
//include "../../dbsetup.php";

$text=search($_POST['search'],$conn);
$text=json_decode($text);
foreach($text as $i){
    foreach($i as $l){
        echo $l;
        echo "<br>";
    }
    echo "<br>";
}

?>
<br>
<a href="searchFuntiontest.html";>TILLBAKA</a>