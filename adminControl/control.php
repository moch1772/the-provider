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
    $post_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/post/read.php';
    $post_JSON=file_get_contents($post_URL);
    $post_array=json_decode($post_JSON,true);
    echo "<table><caption>Posts</caption>";
    echo "<th>postID</th>";
    echo "<th>title</th>";
    echo "<th>text</th>";
    echo "<th>dateTime</th>";
    echo "<th>userID</th>";
    echo "<th>showComments</th>";
    foreach($post_array['data'] as $x){
        echo "<tr>";
        foreach($x as $c){
            echo "<td>$c</td>";
        }
        echo "<td><a href=edit.php?postID=".$x['postID']."><button type=button>EDIT</button></a></td>";
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