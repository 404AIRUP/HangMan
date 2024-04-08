<?php
	include 'common.php'; //include functions
	session_start(); //start session to get session vars
	if(!isset($_SESSION['name'])){ 
		header("location:start.php");
		exit;
	}

	// Array of image filenames
	$imageFiles = array(
		"hangbody1.png", 
		"hangbody2.png",
		"hangbody3.png",
		"hangbody4.png",
		"hangbody5.png",
        "hangbody6.png",
        "hangbody7.png",
	);

	// Function to get the image file based on attempts
	function getImageFile($attempts) {
		global $imageFiles; // Access the $imageFiles array
		$totalImages = count($imageFiles); // Get the total number of images
		$imageIndex = $totalImages - (1 + $attempts); // Calculate the index of the image
		return $imageFiles[$imageIndex]; // Return the image filename
	}

	if (isset($_POST['Submit']) && $_POST['letter'] != '' && $_POST['letter'] != ' ') { //check if submit ented
		$letter = strtolower($_POST['letter']); //store submission in variable
		if (!in_array($letter, $_SESSION['letters'])) { //if the new letter isn't in the letters variable i.e. not entered before
			$_SESSION['letters'][] = $letter; //add the letter to the list of letters
			$_SESSION['warning'] = '';//no warning 
			if (!in_array($letter, $_SESSION['word_id'])) { //if the letter is not in the chosen word
			$_SESSION['attempts'] -=1; //remove chance
			} else { //else (letter is in word)
				$i=0; //index variable starting from 0 (start of array)
				foreach ($_SESSION['word_id'] as $space) { //for each char in the word
					if ($space == $letter) { //if the char matches the letter
						$_SESSION['blank'][$i] = $letter; //replace the equivalent blank space with the letter
					}
				$i++; //increment index	
				}
			}
		} else if($letter!='') { //else (letter already entered) if not blank
			$_SESSION['warning'] = 'You already submitted \'' . $letter . '\''; //create warning
		}
		header("location:corelay.php"); //redirect to same page with updated variables
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
	<style>
	.textback {
opacity: 0;
width: 100%;
height: 15%;
background: black;
z-index: 2900;
top: 40%;
left: 0px;
position:absolute;
animation-duration: 5s;
	animation-delay: 1s;
	animation-name: gameanimback;
	animation-fill-mode: forwards;
}
.gametext {
	opacity: 0;
	font-size: 50pt;
	font-family: "Garamond", serif;
	z-index: 3000;
	position:absolute;
	left: 41%;
	top: 10%;
	animation-duration: 5s;
	animation-delay: 1s;
	animation-name: gameanim;
	animation-fill-mode: forwards;
}
@keyframes gameanim {
	0% {
		opacity: 0;
		transform: scale(0);
	}
	50% {
		opacity: 1;
		transform: scale(1);
	}
	100% {
		transform: scale(1.1);
		opacity: 0;
		display: none;
	}
}
@keyframes gameanimback {
	0% {
		opacity: 0;

	}
	50% {
		opacity: .8;
	}
	100% {
		opacity: 0;
		display: none;
	}
}
	</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hangman Game</h1>
        </div>        
		
        <div class="hangman">
			<?php
					$imageFile = getImageFile($_SESSION['attempts']); // Get the image file based on attempts
					print "<img src='$imageFile' alt='Attempt Image'>"; // Print the image
			?>
		</div>


        <div class="container">
                
            <form action="" method="post">
                <?php if ($_SESSION['attempts'] != 0 && in_array('_', $_SESSION['blank'])): ?>
                    <label for="letter">Enter a Letter:</label>
                    <input name="letter" type="text" id="letter" maxlength="1" autofocus>
                    <input name="Submit" type="submit" value="Submit">
                <?php endif; ?>
                
                <div class="scoreboard">
                    <h3>Score: <?= $_SESSION['score'] ?></h3>
					<p>Round: <?= $_SESSION['rounds'] ?>/6</p>
                    <p>Difficulty: <?= $_SESSION['difficulty'] ?></p>
                    <p>Attempts: <?= $_SESSION['attempts'] ?></p>
                </div>
                
                <div class="word-info">
                    <p class="spaces">Spaces: <?= printArray($_SESSION['blank']) ?></p>
                    <p>Used Letters: <?= printArray($_SESSION['letters']); ?> <?= $_SESSION['warning'] ?></p>
                </div>
                
        <?php
		if (!in_array('_', $_SESSION['blank'])) { //link to next round if word is done, announce win
			win();
			if ($_SESSION['rounds'] ==6) {
				$_SESSION['win'] = true;
				print '<a href="./win.php">Results</a>';
			} else {
				print '<a href="./next.php">Next</a>';
			}
		} else if ($_SESSION['attempts'] ==0) { //announce lose if user is out of attempts
			lose();
		}
	?>
                
                <a href="./reset.php">Reset</a>
            </form>
	</body>
    </div>
</body>
</html>
