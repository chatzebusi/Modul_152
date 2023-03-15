<?php
// this function will check if user logged in and display depend on status buttons
if (!isset($_SESSION)) {
  session_start();
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
      <div class="item-left"><img class="logo" src="../styles/Logo/GalaxyAsteroid.png"></div>
    </div>
    <div class="items-right">
      <div id="profile" class="item-right"><button onclick="changeView('http://localhost/client/views/ProfileView.php')"
          class="button">Profile</button></div>
      <div class="item-right"><button onclick="changeView('http://localhost/client/views/GalleryView.php')"
          class="button">Gallery</button></div>
      <form style="margin: 0em" method="POST">
        <div id="logout" class="item-right"><button class="button" type="logout" name="logout">Logout</button></div>
      </form>
      <div id="login" class="item-right"><button onclick="changeView('http://localhost/client/views/LoginView.php')"
          class="button">Login</button></div>
      <div id="sign-up" class="item-right"><button onclick="changeView('http://localhost/client/views/SignUpView.php')"
          class="button">Sign up</button></div>
    </div>
  </div>
  <!-- Image START -->
  <div class="container">
    <div class="img-container">

      <div class="img-content">
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
  const changeView = link => {
    window.location.href = link
  }
</script>

<?php
require_once('../styles/MainStyles.php');
require_once('../../server/controllers/MenuController.php');
?>

<script type="module">

  import { imageLoad, upVoteImage, downVoteImage } from '../controllers/MenuController.js';

  const imagePaths = <?php echo json_encode($imagePaths); ?>

  const userId = <?php echo $sessionUserId ?>

  // Load one image after another and load first thumbnail
  imagePaths.forEach((path) => {
    let image = document.createElement('img');
    let upVote = document.createElement('button');
    let downVote = document.createElement('button');
    let licenseTxt = document.createElement('p');
    let licenseLink = document.createElement('a');
    let votes = document.createElement('p');
    image.loading = 'lazy';



    licenseTxt.textContent = path.licenseTxt;
    licenseLink.textContent = path.licenseLink;
    licenseLink.href = path.licenseLink;
    votes.textContent = path.votes;

    // add classes
    upVote.classList.add('up-vote-btn');
    downVote.classList.add('down-vote-btn');
    upVote.classList.add('button');
    downVote.classList.add('button');
    licenseLink.classList.add('license-link');
    votes.classList.add('votes');
    upVote.innerHTML = '↑';
    downVote.innerHTML = '↓';

    // add id from image
    upVote.value = path.id;
    downVote.value = path.id;

    // add click event listener
    upVote.addEventListener("click", (event) => {
      upVoteImage(event, userId);
      upVote.disabled = true;
      upVote.style.backgroundColor = '#0000003b';
      upVote.style.cursor = 'unset';

      votes.textContent++;

      downVote.disabled = false;
      downVote.style.backgroundColor = 'transparent';
      downVote.style.cursor = 'pointer';
    });
    downVote.addEventListener("click", (event) => {
      downVoteImage(event, userId);
      downVote.disabled = true;
      downVote.style.backgroundColor = '#0000003b';
      downVote.style.cursor = 'unset';

      if (votes.textContent != 0) {
        votes.textContent -= 1;
      }

      upVote.disabled = false;
      upVote.style.backgroundColor = 'transparent';
      upVote.style.cursor = 'pointer';
    });

    // disable buttons if user have already voted this image
    if (path.isVotedByUser && path.isVotedByUser != false) {
      if (+path.isVotedByUser.votes === 1) {
        upVote.disabled = true;
        upVote.style.backgroundColor = '#0000003b';
        upVote.style.cursor = 'unset';
      } else {
        downVote.disabled = true;
        downVote.style.backgroundColor = '#0000003b';
        downVote.style.cursor = 'unset';
      }
    }


    image.src = path.thumbnail;
    image.className = "homepage-img";
    document.getElementsByClassName('img-content')[0].appendChild(upVote);
    document.getElementsByClassName('img-content')[0].appendChild(downVote);
    document.getElementsByClassName('img-content')[0].appendChild(votes);
    document.getElementsByClassName('img-content')[0].appendChild(image);
    document.getElementsByClassName('img-content')[0].appendChild(licenseTxt);
    document.getElementsByClassName('img-content')[0].appendChild(licenseLink);

    image.addEventListener('load', imageLoad(path.image, image))
  });



</script>