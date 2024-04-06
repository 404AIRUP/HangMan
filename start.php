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
        header("location:corelay.php"); //redirect to game after submit
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
    <link rel="stylesheet" type="text/css" href="animation.css">
</head>
<body>
    <div class="container">
        <div class="falling-letters">
            <span class="letter">H</span>
            <span class="letter">A</span>
            <span class="letter">N</span>
            <span class="letter">G</span>
            <span class="letter">M</span>
            <span class="letter">A</span>
            <span class="letter">N</span>
        </div>
    </div>

    <div class="formcont">
        <form action="" method="post">
            
        Enter Name:<input name="name" type="text" maxlength="15"><?= ' ' . $msg ?><br>
        
            <div class="difficulty">Select Difficulty:</div>

            <div class="option-box">
                <input name="diff" type="radio" value="easy" id="easy">
                <label for="easy" class="easy">Easy</label>
            </div>

            <div class="option-box">
                <input name="diff" type="radio" value="normal" id="normal" checked="checked">
                <label for="normal" class="normal">Normal</label>
            </div>

            <div class="option-box">
                <input name="diff" type="radio" value="hard" id="hard">
                <label for="hard" class="hard">Hard</label>
            </div>
            
            <input name="Submit" type="submit" value="Start">
            <a href="./reset.php">Reset</a>
        </form>
    </div>
</body>
</html>
