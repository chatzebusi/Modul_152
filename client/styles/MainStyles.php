<style>
  <?php
  /* Import all css files */
  require_once('LoginStyle.css');
  require_once('MenuStyle.css');
  require_once('NavigationBarStyle.css');
  require_once('ProfileStyle.css');

  ?>

  /* MAIN STYLES */
  .body {
    background: rgb(255, 0, 211);
    background: linear-gradient(90deg, rgba(255, 0, 211, 1) 0%, rgba(255, 127, 0, 1) 81%, rgba(255, 192, 0, 1) 100%);
    background-attachment: fixed;
  }

  .input {
    background-color: initial;
    border-radius: 10px 10px 10px 10px;
    padding-top: 0.3em;
    padding-bottom: 0.3em;
    padding-left: 0.3em;
    padding-right: 0.3em;
    border-color: black;
    font-family: 'Playfair-Display';
  }

  input:focus {
    outline-width: 0;
    outline: none;
  }

  .button {
    cursor: pointer;
    border-radius: 10px 10px 10px 10px;
    background-color: initial;
    border-color: black;
    height: 3em;
    font-family: 'Playfair-Display';
  }


  .button:active {
    background-color: #0000003b;
  }

  .logo {
    width: 5em;
  }

  p {
    font-family: 'Playfair-Display';
    font-size: 12px;
  }

  a {
    font-family: 'Playfair-Display';
    font-size: 12px;
  }

  select {
    font-family: 'Playfair-Display';
    padding-bottom: 0.1em !important;
    font-size: 14px;
  }

  <?php
  require_once('fonts.php');
  ?>
</style>