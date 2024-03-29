<?php
session_start();
if (isset($_POST['Submit'])) {
		$_SESSION['score']=0;
		$_SESSION['word_id'] = rand(0,9);
		$_SESSION['difficulty'] = $_POST['diff'];
		$_SESSION['attempts'] = 6;
		$_SESSION['test'] = 'test';
		header("location:formurltest.php"); //redirect to getting matched with query parameter from submit
		exit;
    }
?>
<html>
	<head>
	</head>
	<body>
	<form action="" method="post">
	Select Difficulty:
	Easy<input name="diff" type="radio" value="easy">
	Normal<input name="diff" type="radio" value="normal">
	Hard<input name="diff" type="radio" value="hard">
	<input name="Submit" type="submit" value="Start">
	<a href="./reset.php">Reset</a>
	</form>
	</body>
</html>