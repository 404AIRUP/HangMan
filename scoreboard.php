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
    // this stores on local server in .txt note
   // instead of: $scoreFile = 'scores.txt';
	session_start(); // Start session: this stores on server side session
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
	// Check if reset button is clicked
        if (isset($_POST["reset"])) {
			
    // Clear scoreboard by resetting session data
        unset($_SESSION["scores"]);
		
        } else {
    // Get username and score from form
            $username = $_POST["username"];
            $score = intval($_POST["score"]);
            
    // Validate input
            if (!empty($username) && $score > 0) {
				
      // Load scores from session instead of .txt file
            $scores = isset($_SESSION["scores"]) ? $_SESSION["scores"] : [];
                
    // Update scores with new entry
                $scores[$username] = $score;
                
    // Sort scores in descending order
                arsort($scores);
                
    // SAVE SCORES: THIS USES: file_put_contents
                    // Save scores to session
            $_SESSION["scores"] = $scores;
        } else {
            echo "<p>Please enter a valid username and score.</p>";
        }
    }
}


// DISPLAY SCORES: THIS USES: file_get_contents
  echo "<h3>Scoreboard:</h3>";
if (isset($_SESSION["scores"]) && !empty($_SESSION["scores"])) {
    echo "<ol>";
    foreach ($_SESSION["scores"] as $username => $score) {
        echo "<li>$username: $score</li>";
    }
    echo "</ol>";
} else {
    echo "<p>No scores yet.</p>";
}
    ?>
</body>
</html>
