<?php
include 'common.php';
session_start();
if (isset($_POST['Submit'])) {
		$letter = $_POST['letter']; //store submission in variable
		if (!str_contains($_SESSION['letters'],$letter)) {
			$_SESSION['letters'] .= $letter;
			$_SESSION['warning'] = '';
			if (!in_array($letter, $_SESSION['word_id'])) {
			$_SESSION['attempts'] -=1;
			} else {
				$i=0;
				foreach ($_SESSION['word_id'] as $space) {
					if ($space == $letter) {
						$_SESSION['blank'][$i] = $letter;
					}
				$i++;	
				}
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
	<?php
		if (($_SESSION['attempts'] !=0)&&(in_array('_', $_SESSION['blank']))) {
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
		if (!in_array('_', $_SESSION['blank'])) {
			print '<a href="./next.php">Next</a>';
		}
	?>
	<a href="./reset.php">Reset</a>
	</form>
	</body>
</html>