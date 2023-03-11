<?php
// this function will check if user logged in and display depend on status buttons
if (!isset($_SESSION)) {
  session_start();
  if ($_SESSION["userId"]) {
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
      <form style="margin: 0em" method="POST">
        <div id="logout" class="item-right"><button class="button" type="logout" name="logout">Logout</button></div>
      </form>
      <div id="login" class="item-right"><button onclick="changeView('http://localhost/client/views/LoginView.php')"
          class="button">Login</button></div>
      <div id="sign-up" class="item-right"><button onclick="changeView('http://localhost/client/views/SignUpView.php')"
          class="button">Sign up</button></div>
    </div>
  </div>
  <div class="image-wrapper">
    <!-- Image START -->
    <div class="container">
      <div class="img-container">
        <div class="img-content"></div>
      </div>
    </div>
    <!-- Image END -->
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
require_once('../../server/controllers/MenuController.php');
?>

<script>
  const imagePaths = <?php echo json_encode($imagePaths); ?>

  imagePaths.forEach((path) => {
    // TODO add correct styles to show it nicely
    let imgPath = document.createElement('img');
    imgPath.src = path.image;
    imgPath.className = "homepage-img";
    document.getElementsByClassName('img-content')[0].appendChild(imgPath);

    // TODO add thumbnails
    /* let thumbnailPath = document.createElement('img');
    thumbnailPath.src = path.thumbnail;
    thumbnailPath.className = "homepage-img";
    document.getElementsByClassName('img-content')[0].appendChild(thumbnailPath); */
  });

</script>