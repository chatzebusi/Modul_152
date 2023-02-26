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
    <button onclick="changeView('http://localhost/client/views/UploadImageView.php')" class="button button-profile">Upload Image</button>
    <button class="button button-profile">Settings</button>
    <button class="button button-profile">Voted images</button>
    <button class="button button-profile">Uploaded images</button>
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
?>



