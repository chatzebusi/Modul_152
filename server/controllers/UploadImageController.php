<?php
require_once("../../server/models/Tables.php");


$license = getLicense();

// if user press logout button destroy session
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location: http://localhost/client/views/MenuView.php");
}

if (!isset($_POST["submit"])) {
  return $license;
}

if (!isset($_FILES["image"])) {
  return $license;
}

$fileInformation = $_FILES["image"];

if ($fileInformation["size"] > 50000000) {
  return;
}

$userId = $_SESSION["userId"];
$directory = "../../server/storage/uploads/" . $userId . "/";
if (!file_exists($directory)) {
  mkdir($directory, 0777, true);
  mkdir($directory . "/thumbnails", 0777, true);
}

$imageType = mime_content_type($fileInformation["tmp_name"]);

if (!in_array($imageType, array("image/png", "image/jpeg", "image/webp"))) {
  return;
}

$fileName = microtime() . ".png";
if (!move_uploaded_file($fileInformation["tmp_name"], $directory . $fileName)) {
  echo "the file could not be sended";
  return;
}

$image = null;

// TODO add associate array and set function into it
if ($imageType == "image/png") {
  $image = imagecreatefrompng($directory . $fileName);
} else if ($imageType == "image/jpeg") {
  $image = imagecreatefromjpeg($directory . $fileName);
} else if ($imageType == "image/webp") {
  $image = imagecreatefromwebp($directory . $fileName);
}

$scaledImage = imagescale($image, 128);

imagejpeg($scaledImage, $directory . "thumbnails/" . $fileName, 100);

$imagePath = $directory . $fileName;

$thumbnailPath = $directory . "thumbnails/" . $fileName;

// TODO ISSUE => this statement is multiply times execute
setImagePath($imagePath, $thumbnailPath);



/**
 * this function set image and thumbnail path from storage into database
 * @author Alessio Englert
 */
function setImagepath($imagePath, $thumbnailPath)
{
  $tableImage = new Table();
  $tableImage->tableName = "image";
  $result = $tableImage->insertImage($imagePath, $thumbnailPath, $_SESSION["userId"], $_POST['license']);
}

/**
 * this function load all license from database
 * @author Alessio Englert
 */
function getLicense()
{
  $tableLicense = new Table();
  $tableLicense->tableName = "licence";
  $result = $tableLicense->selectLicense();

  $licenses = [];

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $licensesValues = [
      'txt' => $row['licence_txt'],
      'link' => $row['licence_link']
    ];
    array_push($licenses, $licensesValues);
  }


  return $licenses;
}
?>