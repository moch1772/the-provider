<?php 
//require '../../bloggpost.php';
include 'function/search.php';
//include "../../dbsetup.php";
$search=json_encode($_POST['search']);
$text=search($search,$conn);
echo $text;
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