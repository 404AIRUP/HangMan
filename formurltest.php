<?php
session_start();
if (isset($_POST['Submit'])) {
		$letter = $_POST['letter']; //store submission in variable
		if (!str_contains($_SESSION['letters'],$letter)) {
			$_SESSION['letters'] .= $letter;
			$_SESSION['warning'] = '';
			if (!str_contains($_SESSION['test'],$letter)) {
			$_SESSION['attempts'] -=1;
			}	
		} else if($letter!='') {
			$_SESSION['warning'] = 'You already submitted \'' . $letter . '\''; 
		}
		header("location:formurltest.php"); //redirect to getting matched with query parameter from submit
		exit;
    }
?>
<html>
	<head>
	</head>
	<body>
	Test word = <?=$_SESSION['test'] ?>, attempts only decrease if letter isnt in test word <br>
	<form action="" method="post">
	Enter a Letter:<input name="letter" type="text" maxlength="1">
	<input name="Submit" type="submit" value="Submit">
	Score: <?= $_SESSION['score'] ?><br>
	Difficulty: <?= $_SESSION['difficulty'] ?><br>
	Word ID: <?= $_SESSION['word_id'] ?><br>
	Letters: <?= $_SESSION['letters'] ?> <?= $_SESSION['warning'] ?><br>
	Attempts: <?= $_SESSION['attempts'] ?><br>
	<a href="./next.php">Next</a>
	<a href="./reset.php">Reset</a>
	</form>
	</body>
</html>