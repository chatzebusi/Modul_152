<?php
/* require_once("../models/SignUpModel.php"); */
require_once("../../server/models/SignUpModel.php");
// define error variables
$userNameError = "";
$passwordError = "";
$passwordRepeatError = "";
$emailError = "";
$isEmailSetError = "";

// print name if first name is set for better usability after error
if (isset($_POST["userName"])) {
  $userName = $_POST["userName"];
} else {
  $userName = "";
}

// print email if email is set for better usability after error
if (isset($_POST["email"])) {
  $email = $_POST["email"];
} else {
  $email = "";
}

//* VALIDATIONS
if (isset($_POST["submit"])) {

  if (!isset($_POST["email"]) || empty($_POST["email"])) {
    $emailError = "E-mail is not valid";
    return $emailError;
  }
  ;

  if (!isset($_POST["userName"]) || empty($_POST["userName"])) {
    $userNameError = "User name is not valid";
    return $userNameError;
  }
  ;

  if (!isset($_POST["password"]) || empty($_POST["password"])) {
    $passwordError = "password is not valid";
    return $passwordError;
  } else if ($_POST["password"] != $_POST["passwordRepeat"]) {
    $passwordRepeatError = "Password repeat is not equal to Password";
    return $passwordRepeatError;
  }

  $isEmailSetError = userRegistration();
}

/**
 * this function will validate if user with email address always exists, if not it will create new user
 * @return {String} This E-Mail always exists
 * @author Alessio Englert
 */
function userRegistration()
{

  $isEmailSet = false;

  $tableUser = new Table();
  $tableUser->tableName = "user";

  $result = $tableUser->getUserByEmail($_POST["email"]);

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    if (isset($row["email"])) {
      $isEmailSet = true;
    }
  }

  if ($isEmailSet == true) {
    return "This E-Mail always exists";
  }


  $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // insert product into database
  $tableUser->insertIntoUser($_POST["userName"], $_POST["email"], $passwordHash);
}
?>