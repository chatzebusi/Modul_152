<?php
// this function will check if user logged in and display depend on status buttons
if (!isset($_SESSION)) {
  session_start();
  if (!$_SESSION["userId"]) {
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
      <div class="item-left">Item left</div>
    </div>
    <div class="items-right">
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/ProfileView.php')"
          class="button">Profile</button></div>
      <form style="margin: 0em" method="POST">
        <div id="logout" class="item-right"><button class="button" type="logout" name="logout">Logout</button></div>
      </form>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/MenuView.php')"
          class="button">Menu</button></div>
    </div>
  </div>
  <div class="item-wrapper">
    <div class="control-wrapper">
      <form class="upload-image-form" enctype="multipart/form-data" method="POST">
        <input class="input" type="hidden" name="MAX_FILE_SIZE" value="50000000">
        <label onchange="onFilePick()" class="label" for="input-tag">
          Select Image
          <input id="input-tag" class="input-file" type="file" required name="image"
            accept="image/png, image/jpeg, image/webp" />
        </label>
        <button onclick="uploadFile()" class="button upload-file" type="submit" name="submit"
          value="Submit">Upload</button>
      </form>
    </div>
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

  /**
   * this function change the view state from upload button
   * @author Alessio Englert
   */
  const onFilePick = () => {
    document.getElementsByClassName('upload-file')[0].style = 'display: block';
  }

</script>

<?php
require_once('../../server/controllers/UploadImageController.php');
require_once('../styles/MainStyles.php');
?>

<style>
  <?php
  require_once('../styles/UploadImageStyle.css');
  ?>
</style>