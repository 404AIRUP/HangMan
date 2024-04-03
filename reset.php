<?php session_start(); /* Starts the session */
session_destroy(); //delete all variables
header("location:start.php"); /*return to page*/
exit;
?>