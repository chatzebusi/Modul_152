<?php
// this function will check if user logged in and display depend on status buttons
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION["userId"])) {
    // go back to menu view
    header("Location: http://localhost/client/views/MenuView.php");
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
      <div class="item-left"><img class="logo" src="../styles/Logo/GalaxyAsteroid.png"></div>
    </div>
    <div class="items-right">
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/MenuView.php')"
          class="button">Menu</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/GalleryView.php')"
          class="button">Gallery</button></div>
      <form style="margin: 0em" method="POST">
        <div id="logout" class="item-right"><button class="button" type="logout" name="logout">Logout</button></div>
      </form>
    </div>
  </div>

  <div class="item-wrapper">
    <button onclick="changeView('http://localhost/client/views/UploadImageView.php')"
      class="button button-profile">Upload Image</button>
  </div>
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

<?php
require_once('../styles/MainStyles.php');
require_once('../../server/controllers/ProfileController.php');
?>