<?php
//$title=$_POST['title'];
    //$text=$_POST['text'];
    $userID= 1;
    $description=6;
    $dateTime=date("Y-m-d h:i:sa");
    $hidden=1;
    $postID=2;
    $det=1;
    $text='hur monga lingon finns det i världen';
    $title='lingon';
    $arr=array("userID"=> $userID, "bloggID"=> $description, "hidden"=> $hidden, "dateTime"=> $dateTime, "postID"=> $postID, "showComments"=> $det, "text"=> $text, "title"=> $title );
    //echo json_encode($arr);
    $arry=json_encode($arr);
    //$post_URL = file_get_contents('');
    
    $ch=curl_init();
    
    $url="http://localhost:8080/t4/bull/kalender/the-provider/api/post/create.php";

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $arry);

    $output = curl_exec($ch);
echo $output;


    
   
  ?>