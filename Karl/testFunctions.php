<?php 
require '../bloggpost.php';
include 'function.php';
include "../dbsetup.php";

$text=searchTitle($_POST['search'],'title',$conn);
$text=json_decode($text);
//echo $text;
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