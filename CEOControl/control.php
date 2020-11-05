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
    $Report_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/report/unresolved.php';
    $Report_JSON=file_get_contents($Report_URL);
    $Report_array=json_decode($Report_JSON,true);
    echo "<table><caption>Raporterade Poster</caption>";
    echo "<th>postID</th>";
    echo "<th>title</th>";
    echo "<th>text</th>";
    echo "<th>dateTime</th>";
    echo "<th>user name</th>";
    echo "<th>showComments</th>";
    echo "<th>reason</th>";
    $posts=[];
    for ($i=0;$i<(count($Report_array)/7);$i++){
        if($i==0){
            array_push($posts,$Report_array[1]);    
        }else{
        array_push($posts,$Report_array[8*$i-(1*($i-1))]);
        }
    }
    $counter=0;
    foreach($posts as $x){
        $post_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/post/read_single.php?postID='.$x.'';
        $post_JSON=file_get_contents($post_URL);
        $post_array=json_decode($post_JSON,true);
        echo "<tr>";
        $cc=0;
        foreach($post_array as $c){
            if($cc==4){
                $user_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/user/read_single.php?ID='.$c.'';
                $user_JSON=file_get_contents($user_URL);
                $user_array=json_decode($user_JSON,true);
                echo "<td>".$user_array['name']." ".$user_array['lastname']."</td>";
            }else{
                echo "<td>".$c."</td>";  
            }   
            $cc++;
        }
        if($counter==0){
            echo "<td>".$Report_array[3]."</td>";
            $reportID=$Report_array[0];
            echo "<td><a href=edit.php?postID=".$post_array['postID']."><button type=button>Redigera</button></a></td>";
            echo "<td><a href=delete.php?postID=".$post_array['postID']."&reportId=$reportID><button type=button>Radera</button></a></td>";
        }else{
            if($counter==1){
            echo "<td>".$Report_array[10*$counter]."</td>";
            }
            else{
            echo "<td>".$Report_array[10+(7*($counter-1))]."</td>";
            }
            $reportID=$Report_array[7*$counter];
            echo "<td><a href=editPost.php?postID=".$post_array['postID']."><button type=button>Redigera</button></a></td>";
            echo "<td><a href=deletePost.php?postID=".$post_array['postID']."&reportId=$reportID><button type=button>Radera</button></a></td>";
        }
        echo "<td><a href=solvePost.php?reportId=$reportID><button type=button>Löst</button></td>";
        echo "</tr>";
        $counter++;
    }
    echo '</table>';
    $wiki_report_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/Wikireport/readUnresolved.php';
    $wiki_report_JSON=file_get_contents($wiki_report_URL);
    $wiki_report_array=json_decode($wiki_report_JSON,true);
    echo "<table><caption>wikis</caption>";
    echo "<th>wikiID</th>";
    echo "<th>title</th>";
    echo "<th>text</th>";
    echo "<th>date</th>";
    echo "<th>userID</th>";
    echo "<th>version</th>";
    echo "<th>Anledning</th>";
    $wikiToPrint=array();
    $wikiReason=array();
    $WikiReportID=array();
    foreach($wiki_report_array['data'] as $x){
        array_push($wikiToPrint, $x['wikiID']);
        array_push($wikiReason, $x['description']);
        array_push($WikiReportID, $x['reportID']);
    }
    $counter=0;
        echo "<tr>";
        foreach($wikiToPrint as $c){
            //Hämtar vilken wiki som ska skrivas
            $wiki_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/article/read_single.php?wikiID='.$c.'';
            $wiki_JSON=file_get_contents($wiki_URL);
            $wiki_array=json_decode($wiki_JSON,true);
            //print_r($wiki_array);
            //hämtar namn på vem som skrev wikin
            $user_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/user/read_single.php?ID='.$wiki_array['userID'].'';
            $user_JSON=file_get_contents($user_URL);
            $user_array=json_decode($user_JSON,true);
            $name=$user_array['name'].' '.$user_array['lastname'];
            $key = array('userID');
            $names = array_fill_keys($key, $name);
            // Byt ut ID mot namn i wiki_array
            $wiki_array = array_replace($wiki_array, $names);
            //array_replace($wiki_array,$);
            foreach($wiki_array as $element){
            echo "<td>$element</td>";
            }
            echo '<td>'.$wikiReason[$counter].'</td>';
            echo "<td><a href=editWiki.php?wikiID=".$wiki_array['wikiID']."><button type=button>EDIT</button></a></td>";
            echo "<td><a href=deleteWiki.php?wikiID=".$wiki_array['wikiID']."&reportID=".$WikiReportID[$counter]."><button type=button>Radera</button></a></td>";
            echo "<td><a href=solveWiki.php?reportID=".$WikiReportID[$counter]."><button type=button>Löst</button></td>";
            echo "</tr>";
            $counter++;
        }
        
    
?>
</form>