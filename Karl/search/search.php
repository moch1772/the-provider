<?php 
//require '../../bloggpost.php';
include 'searchPost.php';
//include "../../dbsetup.php";
if(isset($_GET['search'])){
$search=json_encode($_GET['search']);
$text=search($search,$conn);
echo $text."<br>";
$text=json_decode($text);


foreach($text as $i){
    foreach($i as $l){
        echo $l;
        echo "<br>";
    }
    echo "<br>";
}
}
?>
<br>
<a href="index.html";>TILLBAKA</a>