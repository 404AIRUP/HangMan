<?php session_start(); /* Starts the session */
  include 'common.php'; //include functions
  $_SESSION['letters']=''; //reset entered letters
  $_SESSION['score'] += $_SESSION['attempts']; //add remaining attempts to the score
  $_SESSION['attempts'] = 6; //reset attempts
  $_SESSION['word_id'] = getWord($_SESSION['difficulty'],rand(0,9)); //get a new word
  $_SESSION['blank'] = getBlank($_SESSION['word_id']); //get new blanks
  $_SESSION['warning'] =''; //reset warning
  header("location:formurltest.php"); /*return to page*/
  exit;
?>