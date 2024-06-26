<?php session_start(); /* Starts the session */
  include 'common.php'; //include functions
  $_SESSION['letters']=array(); //reset entered letters
  $_SESSION['score'] += ($_SESSION['attempts'] * getMult($_SESSION['difficulty'])); //add remaining attempts to the score * diff multiplier
  $_SESSION['attempts'] = 6; //reset attempts
  $_SESSION['word_id'] = getWord($_SESSION['difficulty'],rand(0,9)); //get a new word
  $_SESSION['blank'] = getBlank($_SESSION['word_id']); //get new blanks
  $_SESSION['rounds']++; //increment round number
  $_SESSION['warning'] =''; //reset warning
  header("location:corelay.php"); /*return to page*/
  exit;
?>