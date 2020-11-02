<?php
$resorce= array(
  'userID' => 1,
  'description' => 'nej',
  'dateTime' => ''
);
$rect= 'hur går det min venn';
$dette= date("Y-m-d h:i:sa");


$curl=curl_init();


curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/t4/bull/kalender/the-provider/api/kalender/createEv.php");
curl_setopt($curl, CURLOPT_POSTFIELDS, $resorce);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($curl);

 //$re=json_decode($result);
curl_close($curl);
echo $result;


    
   
  ?>