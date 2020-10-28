<?php
include "../config/db.php";
function tags($conn)
{   
    $result = mysqli_query($conn, "SELECT * FROM tag");
    $request=array();
    while($row = mysqli_fetch_array($result)){
        $holder=array("TagID"=>$row['tagID'],"postID"=>$row['postID'],"tag"=>$row['tag']);
        array_push($request,$holder);
    }
    $request=array_map("unserialize", array_unique(array_map("serialize", $request)));
    $request=json_encode($request,true);
    return $request;
    }

?>