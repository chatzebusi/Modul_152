<?php
require_once("../../server/models/Tables.php");

// if user press logout button destroy session
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location: http://localhost/client/views/MenuView.php");
}

$tableImage = new Table();
$tableImage->tableName = "image";

$result = $tableImage->getAllImages();

$imagePaths = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $path = [
    'image' => $row['storage_path'],
    'thumbnail' => $row['thumbnail_storage_path']
  ];
  array_push($imagePaths, $path);
}

return $imagePaths;
?>