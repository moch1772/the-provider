<?php
$curl=curl_init();
<<<<<<< HEAD
curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/pt/the-provider/fetchReport.php?insertReport=test);
=======
curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/Projekt/Provider/the-provider/fetchReport.php?insertReport=test");
>>>>>>> 78dc96078d697328126d6562b05d33cdf4cb9096
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($curl);
curl_close($curl);
echo $result;
?>