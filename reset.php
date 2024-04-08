<?php session_start(); /* Starts the session */
session_destroy();
header("location:start.php"); /*return to page*/
exit;
?>