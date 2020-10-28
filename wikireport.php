<?php 
    include "dbsetup.php";
?>
<?php 
    function insertWikiReport($conn, $wikiID, $email, $description) {

        if(isset($email)&&isset($description)&&isset($wikiID)) {
         $query=$conn->prepare("INSERT INTO wikireport (wikiID, email, description) values(?, ?, ?)");
         $query->bind_param("iss", $wikiID, $email, $description);
         if($query->execute())      
    
         return TRUE; 
        } else {
            echo "fill fields";
        }
    }

    function insertReportStatus($conn, $reportID , $status) {

    if(isset($reportID)) {
        echo $reportID .=" ";
        echo $status;
    $query=$conn->prepare("UPDATE wikireport set resolved=? where reportID=?");
    $query->bind_param("ii", $status, $reportID);
      if($query->execute())      
    return TRUE;
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="text" name="wikiID" placeholder="wikiID"><br></br>
    <input type="email" name="email" placeholder="email"><br></br>
    <textarea name="description" rows="15" cols="40" placeholder="Description"></textarea>
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>