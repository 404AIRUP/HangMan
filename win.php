<?php
include 'common.php';
session_start();
$_SESSION['score'] += ($_SESSION['attempts'] * getMult($_SESSION['difficulty'])); // Add remaining attempts to the score * difficulty multiplier

if (!$_SESSION['win']) { 
    header("location:start.php");
    exit;
}

// Append user's name and score to a file
$scoreData = $_SESSION['name'] . ' ; ' . $_SESSION['score'] . PHP_EOL; // PHP_EOL represents the end-of-line character
file_put_contents('sname.html', $scoreData, FILE_APPEND);

// Read and display previous users and their scores. I SAVED THIS in sname.html
$previousScores = file_get_contents('sname.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="funclayout.css">
	<style>
		.congrats {
	color: blue;
	opacity: 0;
	font-family: "Garamond", serif;
	animation-duration: 1s;
	animation-delay: 0s;
	animation-name: appear;
	animation-fill-mode: forwards;
}
.wintext {
	color: blue;
	opacity: 0;
	font-family: "Garamond", serif;
	animation-duration: .75s;
	animation-delay: .5s;
	animation-name: appear;
	animation-fill-mode: forwards;
}
.score {
	opacity: 0;
	font-family: "Garamond", serif;
	animation-duration: .75s;
	animation-delay: 1s;
	animation-name: appear;
	animation-fill-mode: forwards;
}
.previous-scores {
	opacity: 0;
	font-family: "Garamond", serif;
	animation-duration: .75s;
	animation-delay: 1.5s;
	animation-name: appear;
	animation-fill-mode: forwards;
}
.back {
	text-align: center;
	opacity: 0;
	font-family: "Garamond", serif;
	animation-duration: .75s;
	animation-delay: 2s;
	animation-name: appear;
	animation-fill-mode: forwards;
}
	h1,h2 {
			text-align: center;
	}
		@keyframes appear {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
             }
        }
	.container {
		text-align: center;
	}
	body {
		background-image: url("background.avif");
		}
	</style>
    <title>Hangman Game</title>
</head>
<body>
    <div class="congrats"><h1>Congratulations!</h1></div>
    <div class="wintext"><h2>You Won!</h2></div>
	<div class="container">
    <div class="score"><h2>Your Score: <?= $_SESSION['score'] ?></h2> </div>
    <div class ="container">
	<div class="previous-scores">
        <h2>Previous Scores:</h2>
        <?php print "<pre>{$previousScores}</pre>"; ?>
    </div>
	</div>
	</div>
    <div class="back"><a href="./reset.php">Return to Start?</a></div>
</body>
</html>