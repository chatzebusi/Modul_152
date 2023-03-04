<?php

function createDatabaseConnection()
{
  // create database connection
  try {
    $database = new PDO("mysql:host=localhost;dbname=modul152", "root", "");
    return $database;
  } catch (Exception $exception) {
    echo "[ERROR]: Cannot connect to Database" . $exception->getMessage();
    die();
  }
  ;
}
?>