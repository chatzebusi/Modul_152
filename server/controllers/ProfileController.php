<?php
// if user press logout button destroy session and redirect user to menu view
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("Location: http://localhost/client/views/MenuView.php");
}
?>