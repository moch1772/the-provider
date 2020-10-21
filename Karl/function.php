<?php 
include "../dbsetup.php";
//needs search word and name of field in string format
function searchTitle($search,$field,$conn)
{
    $result = mysqli_query($conn, "SELECT * FROM post where title like '%$search%'");
    $request=array();
    while($row = mysqli_fetch_array($result)){
        $holder=array("Title"=>$row['title'],"text"=>$row['text'],"Datum_och_tid"=>$row['dateTime']);
        array_push($request,$holder);
    }
    $sql="SELECT postID FROM tag where tag like '%$search%'";
    $tag = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($tag)){
        $sql2="SELECT * FROM post where postID=".$row['postID']."";
        $post = mysqli_query($conn, $sql2);
        while($row = mysqli_fetch_assoc($post)){
           $holder=array("Title"=>$row['title'],"text"=>$row['text'],"Datum_och_tid"=>$row['dateTime']);
            array_push($request,$holder);
        }
    }
    $request=array_map("unserialize", array_unique(array_map("serialize", $request)));
    $request=json_encode($request,true);
    //echo$json;
    //echo"<br>";
    return $request;
    }


?>