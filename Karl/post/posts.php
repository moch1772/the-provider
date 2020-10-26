<?php
include 'GetPosts.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$text=posts($conn);
echo $text;
$text=json_decode($text);


foreach($text as $i){
    foreach($i as $l){
        echo $l;
        echo "<br>";
    }
    echo "<br>";
}
?>
    
</body>
</html>