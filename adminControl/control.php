<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
<form>
<?php
    $Report_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/report/fetchAll.php';
    $Report_JSON=file_get_contents($Report_URL);
    $Report_array=json_decode($Report_JSON,true);
    echo "<table><caption>Posts</caption>";
    echo "<th>postID</th>";
    echo "<th>title</th>";
    echo "<th>text</th>";
    echo "<th>dateTime</th>";
    echo "<th>userID</th>";
    echo "<th>showComments</th>";
    echo "<th>reason</th>";
    $posts=[];
    for ($i=0;$i<(count($Report_array)/7);$i++){
        if($i==0){
            array_push($posts,$Report_array[1]);    
        }else{
        array_push($posts,$Report_array[8*$i]);
        }
    }
    $counter=0;
    foreach($posts as $x){
        $post_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/post/read_single.php?postID='.$x.'';
        $post_JSON=file_get_contents($post_URL);
        $post_array=json_decode($post_JSON,true);
        echo "<tr>";
        foreach($post_array as $c){
            echo "<td>$c</td>";
        }
        if($counter==0){
            echo "<td>".$Report_array[3]."</td>";
        }else{
            echo "<td>".$Report_array[10]."</td>";
        }
        echo "<td><a href=edit.php?postID=".$post_array['postID']."><button type=button>EDIT</button></a></td>";
        echo "<td><button type=button>DELETE</button></td>";
        echo "</tr>";
    }

    $wiki_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/article/read.php';
    $wiki_JSON=file_get_contents($wiki_URL);
    $wiki_array=json_decode($wiki_JSON,true);
    echo "<table><caption>wikis</caption>";
    echo "<th>wikiID</th>";
    echo "<th>title</th>";
    echo "<th>text</th>";
    echo "<th>date</th>";
    echo "<th>userID</th>";
    echo "<th>version</th>";
    foreach($wiki_array['data'] as $x){
        echo "<tr>";
        foreach($x as $c){
            echo "<td>$c</td>";
        }
        echo "<td><a href=edit.php?postID=".$x['wikiID']."><button type=button>EDIT</button></a></td>";
        echo "<td><button type=button>DELETE</button></td>";
        echo "</tr>";
    }
?>
</form>