<?php
include 'common.php'; //include functions
session_start(); //start session to record session vars
if (isset($_POST['Submit'])) { //check if submit is entered
	$msg = '';
	if(empty(str_replace(array("\n", "\t", ' '), '', $_POST["name"]))) {
		$msg = "Invalid entry in name.";
	} else {
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['rounds'] = 0;
        $_SESSION['score'] = 0; //start score from 0
        $_SESSION['difficulty'] = $_POST['diff']; //read difficulty input from form and enter session var
        $_SESSION['word_id'] = getWord($_SESSION['difficulty'], rand(0, 9)); //using the set session var difficulty and a random number, get a word from array of respective difficulty words, store as session array var of chars
        $_SESSION['blank'] = getBlank($_SESSION['word_id']); //using the array of chars, generate an equally long array of underlines
        $_SESSION['attempts'] = 6; //set base attempts of 6
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
   <form action="" method="post">
	Enter Name:<input name="name" type="text" maxlength="15"><?= ' ' . $msg ?><br>
	Select Difficulty:<br>
	Easy<input name="diff" type="radio" value="easy"><br>
	Normal<input name="diff" type="radio" value="normal" checked="checked"><br>
	Hard<input name="diff" type="radio" value="hard"><br>
	<input name="Submit" type="submit" value="Start">
	<a href="./reset.php">Reset</a>
	</form>
</body>
</html>