<?php
include 'common.php'; //include functions
session_start(); //start session to record session vars
if (isset($_POST['Submit'])) { //check if submit is entered
	$msg = '';
	if(empty(str_replace(array("\n", "\t", ' '), '', $_POST["name"]))) { //validate name, check if left blank or only spaces
		$msg = "Invalid entry in name.";
	} else { //valid name entered
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['rounds'] = 1;
        $_SESSION['score'] = 0; //start score from 0
        $_SESSION['difficulty'] = $_POST['diff']; //read difficulty input from form and enter session var
        $_SESSION['word_id'] = getWord($_SESSION['difficulty'], rand(0, 9)); //using the set session var difficulty and a random number, get a word from array of respective difficulty words, store as session array var of chars
        $_SESSION['blank'] = getBlank($_SESSION['word_id']); //using the array of chars, generate an equally long array of underlines
        $_SESSION['attempts'] = 6; //set base attempts of 6
		$_SESSION['letters'] = array(); //create empty array for letters
        header("location:formurltest.php"); //redirect to game after submit
        exit;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" type="text/css" href="startstyle.css">
</head>
<body>
<h1>Hangman</h1>
   <form action="" method="post">
	Enter Name:<input name="name" type="text" maxlength="15"><?= ' ' . $msg ?><br>
	Select Difficulty:<br>
	Easy<input name="diff" type="radio" value="easy"><br>
	Normal<input name="diff" type="radio" value="normal" checked="checked"><br>
	Hard<input name="diff" type="radio" value="hard"><br>
	<input name="Submit" type="submit" value="Start">
	<a href="./reset.php">Reset</a>
	</form>
<h2>How to play:</h2>
<pre>Hangman is played by guessing letters to fill a blank word until it is filled.
A random word will be given to the player in the form of blank spaces. The player then
has the chance to guess a letter that is contained in that word. If that letter does
exist in the given word, the respective position(s) with that letter will be filled. However,
if that letter is not in the word, then "hangman" figure will be progressed, with a body part
added for every wrong guess until it is completed, at which point the player loses.

The player will have to progress through 6 rounds, with the hangman figure and the player's 
chances being reset at the end of each round and a new word assigned. Additionally, all
remaining chances, multiplied by the diffculty (easy = 1x, medium = 2x, hard = 3x) will be 
added to the score.
<pre>
<div class = "scoreboard"><h2>Scoreboard:</h2>
<?= //insert scoreboard ?>
</div>
</body>
</html>
