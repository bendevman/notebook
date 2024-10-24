<?php 
  define('DB_HOST','dbHost');
  define('DB_USER','dbUser');
  define('DB_PASS','dbPassword');
  define('DB_NAME','dbName');

  $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($db->connect_error) {
    die($db->connect_error);
  }
?>