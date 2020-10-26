<?php
include "../../dbsetup.php";
function posts($conn)
{   
    $result = mysqli_query($conn, "SELECT * FROM post");
    $request=array();
    while($row = mysqli_fetch_array($result)){
        $holder=array("Title"=>$row['title'],"text"=>$row['text'],"Datum_och_tid"=>$row['dateTime']);
        array_push($request,$holder);
    }
    $request=array_map("unserialize", array_unique(array_map("serialize", $request)));
    $request=json_encode($request,true);
    return $request;
    }

?>