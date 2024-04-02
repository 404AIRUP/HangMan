<?php
// Define word-point value mapping
$word_points = array(
    "apple" => 1,
    "banana" => 2,
    "orange" => 3,
	"max" => 10,
    // Add more words and their point values as needed
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $submitted_word = strtolower($_POST["word"]); // Convert the submitted word to lowercase for case-insensitive comparison

    // Check if the submitted word exists in the mapping
    if (array_key_exists($submitted_word, $word_points)) {
        $points = $word_points[$submitted_word]; // Assign points based on the submitted word
    } else {
        $points = 0; // No points awarded for wrong guess
    }

    // Save the data to scoreboard.html
    $data_to_save = $user . ";" . $points . ";" . $submitted_word . ";" . "\n";
    file_put_contents("score.html", $data_to_save, FILE_APPEND);
    
    // Display confirmation message
    echo "<h1>HIGH SCORES</h1>";
    echo "<p>Users Recorded.</p>";
    echo "<dl>";
    echo "<dt>USER</dt><dd>" . $user . "</dd>";
    echo "<dt>POINTS</dt><dd>" . $points . "</dd>";
    echo "<dt>WORD</dt><dd>" . $submitted_word . "</dd>";
    echo "</dl>";
    echo "<p>SCORES:</p>";
    echo "<pre>" . file_get_contents("score.html") . "</pre>";

    // Add Try Again button
    echo "<form action='scoreboard.html'>";
    echo "<input type='submit' value='Try Again'>";
    echo "</form>";
}
if (file_put_contents("score.html", $data_to_save, FILE_APPEND) === false) {
    echo "Error writing to file.";
}
?>
