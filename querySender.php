<?php

include "db.php";

if($_POST["submit"] == "Ladda upp"){
  uploadFile($_FILES["fileToUpload"], $conn);
}

if($_POST["submit"] == "Skapa kommentar"){
  insertNewComment($_POST["post"], $_POST["user"], $_POST["commentText"]);
}


function uploadFile($file, $conn)
  {
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
      echo "Sorry, file already exists.";
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

        $sql = "INSERT INTO bilder (sokvag) VALUES ('uploads/".$name."');";
        $conn->query($sql);

      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  function insertNewComment($postID, $anvID, $text){
     if($_POST["commentText"] == ""){
      echo "Text field cannot be left empty."
    } else {
      $sql = $conn->prepare("INSERT INTO kommentarer (postID, anvID, text) VALUES (?, ?, ?);");
      $sql->bind_param("iis", $postID, $anvID, $text);

      $sql->execute();
      $sql->close();

      newBloggLog($postID, $anvID, "New Comment.");
    }
  }

  function newBloggLog($postID, $anvID, $description){
    $sql = $conn->prepare("INSERT INTO blogghistorik (postID, anvID, text) VALUES (?, ?, ?);");
    $sql->bind_param("iis", $postID, $anvID, $description);

    $sql->execute();
    $sql->close();
  }
  
?>