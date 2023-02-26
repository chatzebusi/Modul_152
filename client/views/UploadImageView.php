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
      <div class="item-right"><button onclick="logout()" class="button">Logout</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/MenuView.php')" class="button">Menu</button></div>
    </div>
  </div>

  <div class="item-wrapper">
    <div class="image-wrapper">
      <img class="image" src="../../server/uploads/joanna/Reh.JPG">
    </div>
      <div class="control-wrapper">
      <form class="upload-image-form" enctype="multipart/form-data" method="POST">
      <input class="input" type="hidden" name="MAX_FILE_SIZE" value="50000000">
      <label class="label" for="input-tag">
      Select Image
      <input id="input-tag" class="input-file" type="file" required name="image" accept="image/png, image/jpeg, image/webp"/>
      </label>
      <button class="button" type="submit" name="submit" value="Submit">Upload</button>
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

  const logout = () => {
    // TODO add function to remove cookie

    changeView('http://localhost/client/views/MenuView.php');
  }

</script>

<?php 
  require_once('../styles/MainStyles.php');
  require_once("../../server/controllers/UploadedImageController.php");
?>

