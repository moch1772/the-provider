<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="querySender.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Ladda upp" name="submit">
    </form>
    <br><br>
    <form action="querySender.php" method="post" id="commentForm">
        Write Comment:<br>
        <textarea name="commentText" cols="30" rows="10"></textarea>
        <input type="submit" value="Skapa kommentar" name="submit">
    </form>
</body>

</html>