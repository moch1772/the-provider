<?php
$resorce= 6;
$rect= 'hur går det min venn';
$dette= date("Y-m-d h:i:sa");


$curl=curl_init();


curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/t4/bull/kalender/the-provider/api/moderator/creteBMod.php?userID=".$resorce);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($curl);

 //$re=json_decode($result);
curl_close($curl);
echo $result;


    
   
  ?>