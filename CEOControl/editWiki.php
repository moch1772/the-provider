<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <?php
    $wiki=$_GET['wikiID'];
    
echo "<form id='form' action='updateWiki.php?wikiID=$wiki' method='POST'>";

    
    $wiki_URL = 'http://localhost:8080/Projekt/Provider/the-provider/api/article/read_single.php?wikiID='.$wiki.'';
    $wiki_JSON=file_get_contents($wiki_URL);
    $wiki_array=json_decode($wiki_JSON,true);
    echo "<input type='text' name='title' value='".$wiki_array['title']."'></input><br>";
    echo '<textarea rows="2" cols="5" name="text" form="form">'.$wiki_array['text'].'</textarea>';
?>
<input type="submit" value="Updatera"></input>

</form>