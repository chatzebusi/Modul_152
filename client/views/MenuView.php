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
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/ProfileView.php')" class="button">Profile</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/LoginView.php')" class="button">Login</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/SignUpView.php')" class="button">Sign up</button></div>
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

  // take php value from server and set this value into a javascript variable
  /* const imagePaths = <?php echo json_encode($imagePaths); ?>;

  imagePaths.forEach((image) => {
    // append image
    let imgPath = document.createElement('img');
    imgPath.src = image.image_path;
    imgPath.className = "homepage-img";
    imgPath.id = image.image_id;
    document.getElementsByClassName('img-content')[0].appendChild(imgPath);
  
    // append image name
    let imgName = document.createElement('span');
    imgName.className = "img-name";
    imgName.innerHTML = image.product_name + ' ' + 'Postkarte';
    document.getElementsByClassName('img-content')[0].appendChild(imgName);
  }) */

</script>

<?php 
  require_once('../styles/MainStyles.php');
?>



