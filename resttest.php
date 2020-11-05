<?php



//$title=$_POST['title'];
    //$text=$_POST['text'];
    $pas='hur';
    $description='ner';
    $dateTime=date("Y-m-d h:i:sa");
    $arr=array("password"=> $pas, "name"=> $description);
    echo json_encode($arr);
    $arry=json_encode($arr);
    //$post_URL = file_get_contents('');
    
    $ch=curl_init();
    
    $url="http://localhost:8080/t4/bull/kalender/the-provider/api/moderator/logga.php";

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $arry);

    $output = curl_exec($ch);
echo $output;


    
   
  ?>