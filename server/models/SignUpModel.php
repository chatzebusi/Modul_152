<?php 
  require_once("./DatabaseConnectionModel.php");
  
  $database = createDatabaseConnection();
  
  
  // check if database connected
  if ($database === false) {
    return;
  }

  // TODO add function to create new user
?>