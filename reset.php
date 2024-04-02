<?php
// Clear the contents of the score.html file
file_put_contents("score.html", "");

// Redirect back to the scoreboard page
header("Location: scoreboard.html");
exit; // Ensure script execution stops after redirection
?>