<?php
	include 'common.php'; //include functions
	session_start(); //start session to get session vars
	if(!isset($_SESSION['name'])){ 
	header("location:start.php");
	exit;
}
	if (isset($_POST['Submit'])) { //check if submit ented
		$letter = strtolower($_POST['letter']); //store submission in variable
		if (!in_array($letter, $_SESSION['letters'])) { //if the new letter isn't in the letters variable i.e. not entered before
			$_SESSION['letters'][] = $letter; //add the letter to the list of letters
			$_SESSION['warning'] = '';//no warning 
			if (!in_array($letter, $_SESSION['word_id'])) { //if the letter is not in the chosen word
			$_SESSION['attempts'] -=1; //remove chance
			} else { //else (letter is in word)
				$i=0; //index variable starting from 0 (start of array)
				foreach ($_SESSION['word_id'] as $space) { //for each char in the word
					if ($space == $letter) { //if the char matches the letter
						$_SESSION['blank'][$i] = $letter; //replace the equivalent blank space with the letter
					}
				$i++; //increment index	
				}
			}
		} else if($letter!='') { //else (letter already entered) if not blank
			$_SESSION['warning'] = 'You already submitted \'' . $letter . '\''; //create warning
		}
		header("location:formurltest.php"); //redirect to same page with updated variables
		exit;
    }
?>
<html>
	<head>
	<title>Hangman Game</title>
	<style>
	.textback {
opacity: 0;
width: 100%;
height: 15%;
background: black;
z-index: 2900;
top: 40%;
left: 0px;
position:absolute;
animation-duration: 5s;
	animation-delay: 1s;
	animation-name: gameanimback;
	animation-fill-mode: forwards;
}
.gametext {
	opacity: 0;
	font-size: 50pt;
	font-family: "Garamond", serif;
	z-index: 3000;
	position:absolute;
	left: 41%;
	top: 10%;
	animation-duration: 5s;
	animation-delay: 1s;
	animation-name: gameanim;
	animation-fill-mode: forwards;
}
@keyframes gameanim {
	0% {
		opacity: 0;
		transform: scale(0);
	}
	50% {
		opacity: 1;
		transform: scale(1);
	}
	100% {
		transform: scale(1.1);
		opacity: 0;
		display: none;
	}
}
@keyframes gameanimback {
	0% {
		opacity: 0;

	}
	50% {
		opacity: .8;
	}
	100% {
		opacity: 0;
		display: none;
	}
}
	</style>
	</head>
	<body>
	<form action="" method="post">
	<?php
		if (($_SESSION['attempts'] !=0)&&(in_array('_', $_SESSION['blank']))) { //create submit button if the game is ongoing i.e. user hasn't lost (attempts not 0) or is finished (no blanks left, word filled)
			print 'Enter a Letter:<input name="letter" type=text" maxlength="1" autofocus>
			<input name="Submit" type="submit" value="Submit">';
		}
	?>
	Score: <?= $_SESSION['score'] ?><br>
	Difficulty: <?= $_SESSION['difficulty'] ?><br>
	Word ID: <?= printArray($_SESSION['word_id']); ?><br>
	Spaces: <?= printArray($_SESSION['blank']); ?><br>
	Letters: <?= printArray($_SESSION['letters']); ?> <?= $_SESSION['warning'] ?><br>
	Attempts: <?= $_SESSION['attempts'] ?><br>
	Rounds: <?= $_SESSION['rounds'] . "/6" ?><br>
	<?php
		if (!in_array('_', $_SESSION['blank'])) { //link to next round if word is done, announce win
			win();
			if ($_SESSION['rounds'] ==6) {
				print '<a href="./win.php">Results</a>';
			} else {
				print '<a href="./next.php">Next</a>';
			}
		} else if ($_SESSION['attempts'] ==0) { //announce lose if user is out of attempts
			lose();
		}
	?>
	<a href="./reset.php">Reset</a>
	</form>
	</body>
</html>