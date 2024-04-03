<?php
	include 'common.php'; //include functions
	session_start(); //start session to get session vars
	if (isset($_POST['Submit'])) { //check if submit ented
		$letter = $_POST['letter']; //store submission in variable
		if (!str_contains($_SESSION['letters'],$letter)) { //if the new letter isn't in the letters variable i.e. not entered before
			$_SESSION['letters'] .= $letter; //add the letter to the list of letters
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
	</head>
	<body>
	Test word = <?=$_SESSION['test'] ?>, attempts only decrease if letter isnt in test word <br>
	<form action="" method="post">
	<?php
		if (($_SESSION['attempts'] !=0)&&(in_array('_', $_SESSION['blank']))) { //create submit button if the game is ongoing i.e. user hasn't lost (attempts not 0) or is finished (no blanks left, word filled)
			print 'Enter a Letter:<input name="letter" type=text" maxlength="1">
			<input name="Submit" type="submit" value="Submit">';
		}
	?>
	Score: <?= $_SESSION['score'] ?><br>
	Difficulty: <?= $_SESSION['difficulty'] ?><br>
	Word ID: <?= printArray($_SESSION['word_id']); ?><br>
	Spaces: <?= printArray($_SESSION['blank']); ?><br>
	Letters: <?= $_SESSION['letters'] ?> <?= $_SESSION['warning'] ?><br>
	Attempts: <?= $_SESSION['attempts'] ?><br>
	<?php
		if (!in_array('_', $_SESSION['blank'])) { //link to next round if word is done
			print '<a href="./next.php">Next</a>';
		}
	?>
	<a href="./reset.php">Reset</a>
	</form>
	</body>
</html>