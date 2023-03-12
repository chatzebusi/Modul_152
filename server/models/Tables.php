<?php
require_once("DatabaseConnectionModel.php");

$database = createDatabaseConnection();


// check if database connected
if ($database === false) {
  return;
}

class Table
{
  public $tableName;

  /**
   * insert statement to add new user
   * @param {String} $userName
   * @param {String} $email
   * @param {String} $password
   * @author Alessio Englert
   */
  public function insertIntoUser($userName, $email, $password)
  {
    global $database;
    $database->beginTransaction();
    try {

      // prepare insert statement
      $statement = $database->prepare("INSERT INTO " . $this->tableName . "(name, password, email) VALUES(?, ?, ? );");

      // bind products
      $statement->bindParam(1, $userName, PDO::PARAM_STR);
      $statement->bindParam(2, $password, PDO::PARAM_STR);
      $statement->bindParam(3, $email, PDO::PARAM_STR);


      $statement->execute();

      $database->commit();
    } catch (Exception $exception) {
      $database->rollBack();
      echo "Failed to add new user into database, please contact our support Team under alessio.englert+support@evosys.ch";
      die();
    }
  }

  /**
   * this function get user by email
   * @param {String} email
   * @return {PDO:Object} statement
   * @author Alessio Englert
   */
  public function getUserByEmail($email)
  {
    global $database;
    $database->beginTransaction();
    try {

      $statement = $database->prepare("SELECT * FROM " . $this->tableName . " WHERE email = ?");

      $statement->bindParam(1, $email, PDO::PARAM_STR);

      $statement->execute();

      $database->commit();

      return $statement;

    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  /**
   * this function insert new image and thumbnail path from uploaded image
   * @param {String} imagePath
   * @param {String} thumbnailPath
   * @param {Integer} userId
   * @author Alessio Englert
   */
  public function insertImage($imagePath, $thumbnailPath, $userId, $license)
  {
    global $database;
    $database->beginTransaction();
    try {

      $licenseStatement = $database->prepare("SELECT licence_id FROM licence WHERE licence_txt=?;");

      $licenseStatement->bindParam(1, $license, PDO::PARAM_STR);

      $licenseStatement->execute();

      $licenseId = 0;

      while ($row = $licenseStatement->fetch(PDO::FETCH_ASSOC)) {
        $licenseId = $row['licence_id'];
      }

      $statement = $database->prepare("INSERT INTO image(user_id, storage_path, thumbnail_storage_path, licence_id) VALUES(?,?,?,?);");

      $statement->bindParam(1, $userId, PDO::PARAM_INT);
      $statement->bindParam(2, $imagePath, PDO::PARAM_STR);
      $statement->bindParam(3, $thumbnailPath, PDO::PARAM_STR);
      $statement->bindParam(4, $licenseId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function getAllImages()
  {
    global $database;
    $database->beginTransaction();
    try {

      $statement = $database->prepare('SELECT * FROM image ORDER BY image_id DESC;');

      $statement->execute();

      $database->commit();

      return $statement;

    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function selectLicense()
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('SELECT * FROM licence;');

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function selectVote($imageId, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('SELECT * FROM vote WHERE user_id=? AND image_id=?;');

      $statement->bindParam(1, $userId, PDO::PARAM_INT);
      $statement->bindParam(2, $imageId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function insertUpVote($imageId, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('INSERT INTO vote(image_id, votes, user_id) VALUES(?, ?, ?)');

      $upVote = 1;

      $statement->bindParam(1, $imageId, PDO::PARAM_INT);
      $statement->bindParam(2, $upVote, PDO::PARAM_INT);
      $statement->bindParam(3, $userId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function insertDownVote($imageId, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('INSERT INTO vote(image_id, votes, user_id) VALUES(?, ?, ?)');

      $upVote = 0;

      $statement->bindParam(1, $imageId, PDO::PARAM_INT);
      $statement->bindParam(2, $upVote, PDO::PARAM_INT);
      $statement->bindParam(3, $userId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function updateUpVote($imageId, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('UPDATE vote SET votes=? WHERE image_id=? AND user_id=?');

      $upVote = 1;

      $statement->bindParam(1, $upVote, PDO::PARAM_INT);
      $statement->bindParam(2, $imageId, PDO::PARAM_INT);
      $statement->bindParam(3, $userId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function updateDownVote($imageId, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('UPDATE vote SET votes=? WHERE image_id=? AND user_id=?');

      $upVote = 0;

      $statement->bindParam(1, $upVote, PDO::PARAM_INT);
      $statement->bindParam(2, $imageId, PDO::PARAM_INT);
      $statement->bindParam(3, $userId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function getLicenseByLicenseId($licenseId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('SELECT * FROM licence WHERE licence_id=?');

      $statement->bindParam(1, $licenseId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      return $statement;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }

  public function getVotesByImageId($imageId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare('SELECT * FROM vote WHERE image_id=?');

      $statement->bindParam(1, $imageId, PDO::PARAM_INT);

      $statement->execute();

      $database->commit();

      // get quantity of all votes from image
      $counter = 0;
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($row['votes'] == 1) {
          $counter++;
        } else {
          $counter - 1;
        }
      }


      // if counter negative, set it to 0
      if ($counter < 0) {
        $counter = 0;
      }

      return $counter;
    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }
}
?>