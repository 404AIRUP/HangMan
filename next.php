<?php session_start(); /* Starts the session */
$_SESSION['letters']='';
$_SESSION['score'] += $_SESSION['attempts'];
$_SESSION['attempts'] =6;
$_SESSION['word_id'] = rand(0,9);
$_SESSION['warning'] ='';
header("location:formurltest.php"); /*return to page*/
exit;
?>