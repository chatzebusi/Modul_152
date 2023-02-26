<?php 
  if (!isset($_POST["submit"])) {
    return;
  }

  if (!isset($_FILES["image"])) {
    return;
  }
  
  $fileInformation = $_FILES["image"];

  if ($fileInformation["size"] > 50000000) {
    return;
  }

  //mkdir("create directory", 0777)



  // realtiver pfad von dem upload file (view)
  // es muss berechtigung für alle auf dem order eingestellt werden damit irgendein benutzer es in dieses Directory uploaden kann

  $imageType = mime_content_type($fileInformation["tmp_name"]);

  if (!in_array($imageType, array("image/png", "image/jpeg", "image/webp"))) {
    return;
  }

  $fileName = microtime();
  if (!move_uploaded_file($fileInformation["tmp_name"], "uploads/" . $fileName)) {
    echo "the file could not be sended";
    return;
  }

  $image = null;

  // TODO make assocative array with all functions and the keys are image/png or the other types
  if ($imageType == "image/png") {
    $image = imagecreatefrompng("uploads/" . $fileName);
  } else if ($imageType == "image/jpeg") {
    $image = imagecreatefromjpeg("uploads/" . $fileName);
  } else if ($imageType == "image/webp") {
    $image = imagecreatefromwebp("uploads/" . $fileName);
  }

  $scaledImage = imagescale($image, 128);

  imagejpeg($scaledImage, "uploads/thumbnails/" . $fileName, 100);
?>