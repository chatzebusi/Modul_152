<?php
require_once("../../server/models/Tables.php");
$imageId = $_POST['imageId'];
$userId = $_POST['userId'];

$tableVote = new Table();
$tableVote->tableName = "vote";

$result = $tableVote->selectVote($imageId, $userId);

$isImageVoted = false;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  if (isset($row['vote_id'])) {
    $isImageVoted = true;
  }
}

// if this image not voted by user, insert new vote, else update last vote
if ($isImageVoted === false) {
  $result = $tableVote->insertDownVote($imageId, $userId);
} else {
  $result = $tableVote->updateDownVote($imageId, $userId);
}
?>