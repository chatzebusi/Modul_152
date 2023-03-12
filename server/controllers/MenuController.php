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

$tableLicense = new Table();
$tableLicense->tableName = "licence";

$tableVote = new Table();
$tableVote->tableName = "vote";

$imagePaths = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  // get license form image
  $licenseResult = $tableLicense->getLicenseByLicenseId($row['licence_id']);
  $licenseRow = $licenseResult->fetch(PDO::FETCH_ASSOC);

  // get all votes from image
  $voteResult = $tableVote->getVotesByImageId($row['image_id']);

  // get votes specific by user and image
  $voteUserImageResult = false;
  if (isset($_SESSION['userId'])) {
    $voteUserImageResult = $tableVote->selectVote($row['image_id'], $_SESSION['userId']);
    $voteUserImageResult = $voteUserImageResult->fetch(PDO::FETCH_ASSOC);
  }

  $path = [
    'image' => $row['storage_path'],
    'thumbnail' => $row['thumbnail_storage_path'],
    'id' => $row['image_id'],
    'licenseTxt' => $licenseRow['licence_txt'],
    'licenseLink' => $licenseRow['licence_link'],
    'votes' => $voteResult,
    'isVotedByUser' => $voteUserImageResult,
  ];
  array_push($imagePaths, $path);
}

return $imagePaths;

?>