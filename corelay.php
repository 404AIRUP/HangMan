<?php
	include 'common.php'; //include functions
	session_start(); //start session to get session vars

	// Array of image filenames
	$imageFiles = array(
		"image0.jpg", // Replace with actual filenames
		"image1.jpg",
		"image2.jpg",
		"image3.jpg",
		"image4.jpg"
	);

	// Function to get the image file based on attempts
	function getImageFile($attempts) {
		global $imageFiles; // Access the $imageFiles array
		$totalImages = count($imageFiles); // Get the total number of images
		$imageIndex = $totalImages - $attempts; // Calculate the index of the image
		return $imageFiles[$imageIndex]; // Return the image filename
	}

	if (isset($_POST['Submit'])) { //check if submit entered
		$letter = $_POST['letter']; //store submission in variable
		if (!str_contains($_SESSION['letters'],$letter)) { //if the new letter isn't in the letters variable i.e. not entered before
			$_SESSION['letters'] .= $letter; //add the letter to the list of letters
			$_SESSION['warning'] = ''; //no warning 
			if (!in_array($letter, $_SESSION['word_id'])) { //if the letter is not in the chosen word
				$_SESSION['attempts'] -= 1; //remove chance
			} else { //else (letter is in word)
				$i = 0; //index variable starting from 0 (start of array)
				foreach ($_SESSION['word_id'] as $space) { //for each char in the word
					if ($space == $letter) { //if the char matches the letter
						$_SESSION['blank'][$i] = $letter; //replace the equivalent blank space with the letter
					}
					$i++; //increment index	
				}
			}
		} else if ($letter != '') { //else (letter already entered) if not blank
			$_SESSION['warning'] = 'You already submitted \'' . $letter . '\''; //create warning
		}
		header("location:formurltest.php"); //redirect to same page with updated variables
		exit;
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman</title>
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
        
		Test word = <?= $_SESSION['test'] ?>, attempts only decrease if letter isn't in test word <br>
		
        <div class="hangman">
			<?php
				if (($_SESSION['attempts'] !=0) && (in_array('_', $_SESSION['blank']))) { // Display the image if attempts remaining and word is not yet complete
					$imageFile = getImageFile($_SESSION['attempts']); // Get the image file based on attempts
					print "<img src='$imageFile' alt='Attempt Image'>"; // Print the image
				}
			?>
		</div>


        <div class="container">
                
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
	</body>
    </div>
</body>
</html>
