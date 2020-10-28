<?php
$resorce=$_POST['anvendare'];
echo $resorce;

$curl=curl_init();


curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/t4/bull/kalender/the-provider/moder.php?nomore=".$resorce);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($curl);
curl_close($curl);
echo $result;


    
   
  ?>