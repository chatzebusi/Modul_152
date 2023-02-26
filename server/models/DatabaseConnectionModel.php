<?php

function createDatabaseConnection() {
  // check database connection
  $database = new mysqli("localhost", "root", "", "modul152");
  if(!$database) {
    echo "no connection to database";
    return false;
  };
  
  return $database;
}
?>