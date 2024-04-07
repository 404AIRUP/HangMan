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
    <title>Hangman Game</title>
</head>
<body>
    <div class="congrats">Congratulations!</div>
    <div class="wintext">You Won!</div>
    <div class="score">Your Score: <?= $_SESSION['score'] ?> </div>
    <div class="previous-scores">
        <h2>Previous Scores:</h2>
        <?php print "<pre>{$previousScores}</pre>"; ?>
    </div>
    <div class="back"><a href="./reset.php">Return to Start?</a></div>
</body>
</html>