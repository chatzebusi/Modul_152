<?php
require_once('../../server/controllers/LoginController.php');
require_once('../styles/MainStyles.php');
// this function will check if user logged in and display depend on status buttons
if (!isset($_SESSION)) {
  if (isset($_SESSION["userId"])) {
    $sessionUserId = $_SESSION["userId"];
    ?>
    <style type="text/css">
      #sign-up {
        display: none;
      }

      #login {
        display: none;
      }
    </style>
    <?php
  } else {
    $sessionUserId = null;
    ?>
    <style type="text/css">
      #profile {
        display: none;
      }

      #logout {
        display: none;
      }
    </style>
    <?php
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
</head>

<body class="body">
  <div class="navbar-wrapper">
    <div class="items-left">
      <div class="item-left">Item left</div>
    </div>
    <div class="items-right">
      <div id="profile" class="item-right"><button onclick="changeView('http://localhost/client/views/ProfileView.php')"
          class="button">Profile</button></div>
      <div id="sign-up" class="item-right"><button onclick="changeView('http://localhost/client/views/SignUpView.php')"
          class="button">Sign Up</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/MenuView.php')"
          class="button">Menu</button></div>
    </div>
  </div>


  <form method="POST">

    <div class="sign-up-wrapper">

      <!-- User inputs START -->
      <label class="label" for="firstName">User name</label>
      <input maxlength="250" type="text" required name="userName" value="<?php echo $userName; ?>">
      <span class="validation-error">
        <?php echo "$userNameError" ?>
      </span>

      <label class="label" for="email">Email</label>
      <input maxlength="250" type="email" required name="email" value="<?php echo $email; ?>">
      <span class="validation-error">
        <?php echo "$emailError" ?>
      </span>
      <label class="label" for="password">Password</label>
      <input maxlength="250" type="password" required name="password">
      <span class="validation-error">
        <?php echo "$passwordError" ?>
      </span>

      <label class="label" for="passwordRepeat">Password repeat</label>
      <input maxlength="250" type="password" required name="passwordRepeat">
      <span class="validation-error">
        <?php echo "$passwordRepeatError" ?>
      </span>
      <!-- User inputs END -->

      <!-- Registration START -->
      <button class="button submit-sign-up" type="submit" name="submit">Login</button>
      <span style="margin-top: 1em" class="validation-error">
        <?php echo "$isLoginError" ?>
      </span>
      <!-- Registration END -->

    </div>
  </form>
</body>

</html>

<script>
  /**
   * this function change the view depend on button
   * @param {String} link
   * @author Alessio Englert
   */
  const changeView = (link) => {
    window.location.href = link;
  }
</script>

<style>
  <?php
  require_once('../styles/LoginStyle.css');
  ?>
</style>