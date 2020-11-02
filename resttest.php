<?php



//$resorce= 4;
$rect= 'hur går det min venn';
$dette= date("Y-m-d h:i:sa");

//$pleb = json_encode(array( 'men' => $resorce));

$data = array(
  'userID' => '1',
  'description' => 'sluta med shit',
  'dateTime' => '$dette',
);


$curl=curl_init();

curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/t4/bull/kalender/the-provider/api/kalender/createEv.php");
curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$result=curl_exec($curl);

 //$re=json_decode($result);
curl_close($curl);
echo $result;


    
   
  ?>