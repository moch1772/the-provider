<?php 
include "../dbsetup.php";
//needs search word and name of field in string format
function searchTitle($search,$field,$conn)
{
    $result = mysqli_query($conn, "SELECT * FROM post where title like '%$search%'");
    $request=array();
    while($row = mysqli_fetch_array($result)){
        array_push($request,$row[$field]);
    }
    return $request;
    }


?>