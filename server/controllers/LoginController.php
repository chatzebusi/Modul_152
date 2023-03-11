<?php
require_once("../../server/models/Tables.php");
// define error variables
$userNameError = "";
$passwordError = "";
$passwordRepeatError = "";
$emailError = "";
$isLoginError = "";

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

  $isLoginError = userVerification();
}

/**
 * this function verify user and set after verify session cookie
 * @return {String} This E-Mail always exists
 * @author Alessio Englert
 */
function userVerification()
{
  $tableUser = new Table();
  $tableUser->tableName = "user";

  $result = $tableUser->getUserByEmail($_POST["email"]);

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    if (isset($row["email"]) && password_verify($_POST["password"], $row["password"])) {
      // set max time to session
      session_start();
      $_SESSION["expiration"] = time() + 3600;
      $_SESSION["userId"] = $row["user_id"];

      // navigate to homepage
      return header("Location: http://localhost/client/views/MenuView.php");
    }
  }
  return "password or email does not match";
}
?>