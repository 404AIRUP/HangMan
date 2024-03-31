<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" type="text/css" href="funclayout.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hangman Game</h1>
        </div>
        
        <div class="profile-info">
            <h2>Test word: <?= $_SESSION['test'] ?></h2>
            <p>Attempts only decrease if letter isn't in test word.</p>
        </div>
        
        <form action="" method="post">
            <?php if ($_SESSION['attempts'] != 0 && in_array('_', $_SESSION['blank'])): ?>
                <label for="letter">Enter a Letter:</label>
                <input name="letter" type="text" id="letter" maxlength="1">
                <input name="Submit" type="submit" value="Submit">
            <?php endif; ?>
            
            <div class="scoreboard">
                <h3>Score: <?= $_SESSION['score'] ?></h3>
                <p>Difficulty: <?= $_SESSION['difficulty'] ?></p>
                <p>Attempts: <?= $_SESSION['attempts'] ?></p>
            </div>
            
            <div class="word-info">
                <p>Word ID: <?= printArray($_SESSION['word_id']) ?></p>
                <p>Spaces: <?= printArray($_SESSION['blank']) ?></p>
                <p>Letters: <?= $_SESSION['letters'] ?> <?= $_SESSION['warning'] ?></p>
            </div>
            
            <?php if (!in_array('_', $_SESSION['blank'])): ?>
                <a href="./next.php">Next</a>
            <?php endif; ?>
            
            <a href="./reset.php">Reset</a>
        </form>
    </div>
</body>
</html>
