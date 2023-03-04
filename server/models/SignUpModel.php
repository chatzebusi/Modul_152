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

      // TODO add logic to create a password hash

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

  public function getUserByEmail($email)
  {
    global $database;
    $database->beginTransaction();
    try {

      $statement = $database->prepare("SELECT * FROM " . $this->tableName . " WHERE email = ?");

      // bind products
      $statement->bindParam(1, $email, PDO::PARAM_STR);

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