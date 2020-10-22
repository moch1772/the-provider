<?php 
include "../dbsetup.php";
//returns json array with the elements from the database that conn conects to.
//the elements has to do with the search word in som way in tags or in title
function search($search,$conn)
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
    return $request;
    }


?>