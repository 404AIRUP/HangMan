<!DOCTYPE html>
<html>
<head>
    <title>Simple Scoreboard</title>
</head>
<body>
    <h2>Scoreboard</h2>
	<!-- I made a from method post that stores username and score with a submit and reset button-->   
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="score">Score:</label>
        <input type="number" id="score" name="score" required><br><br>
        
        <input type="submit" value="Submit Score">
        <input type="submit" name="reset" value="Reset Scoreboard">
    </form>

    <?php
    // this is the variable scoreFIle to store scores.
    $scoreFile = 'scores.txt';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
	// Check if reset button is clicked
        if (isset($_POST["reset"])) {
			
    // Clear scoreboard by deleting the score file
            if (file_exists($scoreFile)) {
                unlink($scoreFile);
            }
        } else {
    // Get username and score from form
            $username = $_POST["username"];
            $score = intval($_POST["score"]);
            
    // Validate input
            if (!empty($username) && $score > 0) {
    // Load scores from file
                $scores = [];
                if (file_exists($scoreFile)) {
                    $scores = unserialize(file_get_contents($scoreFile));
                }
                
    // Update scores with new entry
                $scores[$username] = $score;
                
    // Sort scores in descending order
                arsort($scores);
                
    // SAVE SCORES: THIS USES: file_put_contents
                file_put_contents($scoreFile, serialize($scores));
            } else {
                echo "<p>Please enter a valid username and score.</p>";
            }
        }
    }

// DISPLAY SCORES: THIS USES: file_get_contents
    echo "<h3>Scoreboard:</h3>";
    if (file_exists($scoreFile)) {
        $scores = unserialize(file_get_contents($scoreFile));
        echo "<ol>";
        foreach ($scores as $username => $score) {
            echo "<li>$username: $score</li>";
        }
        echo "</ol>";
    } else {
//no entries w an else statement
        echo "<p>No scores yet.</p>";
    }
    ?>
</body>
</html>
