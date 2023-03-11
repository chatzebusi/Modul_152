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
  public function insertImage($imagePath, $thumbnailPath, $userId)
  {
    global $database;
    $database->beginTransaction();
    try {
      $statement = $database->prepare("INSERT INTO image(user_id, storage_path, thumbnail_storage_path) VALUES(?,?,?);");

      $statement->bindParam(1, $userId, PDO::PARAM_INT);
      $statement->bindParam(2, $imagePath, PDO::PARAM_STR);
      $statement->bindParam(3, $thumbnailPath, PDO::PARAM_STR);

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

      $statement = $database->prepare('SELECT * FROM image;');

      $statement->execute();

      $database->commit();

      return $statement;

    } catch (Exception $exception) {
      $database->rollBack();
      die();
    }
  }
}
?>