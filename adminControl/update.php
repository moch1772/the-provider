
<?php


    $title=$_POST['title'];
    $text=$_POST['text'];
    $arr=array("postID"=> 5, "title"=> $title,"text"=> $text);
    echo json_encode($arr);
    $arry=json_encode($arr);
    //$post_URL = file_get_contents('');
    
    $ch=curl_init();
    
    $url="http://localhost:8080/Projekt/Provider/the-provider/api/post/update.php";

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $arry);

    $output = curl_exec($ch);




?>