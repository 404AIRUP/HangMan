<?php
include 'common.php';
session_start();
$_SESSION['score'] += ($_SESSION['attempts'] * getMult($_SESSION['difficulty'])); //add remaining attempts to the score * diff multiplier
if(!($_SESSION['win'])){ 
	header("location:start.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hangman Game</title>
</head>
<body>
	<div class = "congrats">Congratulations!</div>
	<div class = "wintext">You Won!</div>
	<div class= "score">Your Score: <?= $_SESSION['score'] ?> </div>
	<div class = "prev">
		Previous Users:
	</div>
	<div class = "back"><a href="./reset.php">Return to Start?</a></div>
</body>
</html>