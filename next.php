<?php session_start(); /* Starts the session */
include 'common.php';
$_SESSION['letters']='';
$_SESSION['score'] += $_SESSION['attempts'];
$_SESSION['attempts'] = 6;
$_SESSION['word_id'] = getWord($_SESSION['difficulty'],rand(0,9));
$_SESSION['blank'] = getBlank($_SESSION['word_id']);
$_SESSION['warning'] ='';
header("location:corelay.php"); /*return to page*/
exit;
?>