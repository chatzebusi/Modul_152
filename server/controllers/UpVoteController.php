<?php
require_once("../../server/models/Tables.php");
$imageId = $_POST['imageId'];
$userId = $_POST['userId'];

$tableVote = new Table();
$tableVote->tableName = "vote";

$result = $tableVote->selectVote($imageId, $userId);

$isImageVoted = false;
$isUpVote = 2;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  if (isset($row['vote_id'])) {
    $isImageVoted = true;
    $isUpVote = $row['vote_id'];
  }
}

// if this image not voted by user, insert new vote, else update last vote
if ($isImageVoted === false) {
  $result = $tableVote->insertUpVote($imageId, $userId);
} else {
  $result = $tableVote->updateUpVote($imageId, $userId);
}

/* if ($isUpVote == 2 || $isUpVote == 0) {
return true;
} else {
return false;
} */
?>