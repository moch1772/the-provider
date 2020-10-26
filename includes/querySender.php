<?php

include "db.php";

function uploadFile($file, $postID, $wiki, $xPos, $yPos, $conn){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($file["name"]);
  $errorCheck = 1;
  $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $check = getimagesize($file["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $errorCheck = 1;
  } else {
    echo "File is not an image.";
    $errorCheck = 0;
  }

  if(file_exists($target_file)) {
    echo "<br>Sorry, file already exists.";
    $errorCheck = 0;
  }
      
  if($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $errorCheck = 0;
  }
      
  if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
  && $fileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $errorCheck = 0;
  }
      
  if ($errorCheck == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $name = htmlspecialchars(basename($file["name"]));
      echo "The file ".$name." has been uploaded.";

      $sokvag = "";

      $sql = $conn->prepare("INSERT INTO bilder (sokvag, postID, wiki, yPos, xPos) VALUES (?, ?, ?, ?, ?);");
      $sql->bind_param("siiss", $sokvag, $postID, $wiki, $yPos, $xPos);

      $sokvag = "uploads/".$name;
      $sql->execute();
      $sql->close();

    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

function insertNewComment($postID, $userID, $text, $conn){
  if($_POST["commentText"] == ""){
    echo "Text field cannot be left empty.";
  } else {
    $sql = $conn->prepare("INSERT INTO kommentarer (postID, anvID, text) VALUES (?, ?, ?);");
    $sql->bind_param("iis", $postID, $userID, $text);

    $sql->execute();
    $sql->close();

    newBloggLog($userID." made a comment on ".$postID, $conn);
  }
}

function removeComment($commentID, $conn){
  $sql = "DELETE FROM kommentarer WHERE kommentarID = ".$commentID.";";
  $conn->query($sql);

  
  newBloggLog("The comment with the comment ID: ".$commentID." was removed.", $conn);
}

function newBloggLog($description, $conn){
  $sql = $conn->prepare("INSERT INTO blogghistorik (text) VALUES (?);");
  $sql->bind_param("s", $description);

  $sql->execute();
  $sql->close();
}
  
function editComment($commentID, $newText, $conn){
  $sql = $conn->prepare("UPDATE comment SET text = ? WHERE commentID = $commentID;");
  $sql->bind_param("s", $newText);

  $sql->execute();
  $sql->close();

  newBloggLog("The comment with the comment ID: ".$commentID." was edited.", $conn);
}


?>