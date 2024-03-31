<?php session_start(); /* Starts the session */
  session_destroy(); //destroy session i.e. reset all session variables
  header("location:start.php"); /*return to start page*/
  exit;
?>
