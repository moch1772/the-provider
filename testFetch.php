<?php
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/pt/the-provider/fetchReport.php?insertReport=test);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($curl);
curl_close($curl);
echo $result;
?>