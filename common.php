<?php
	function getWord ($diff, $i) { //function to get a word
		$easy = array("good","boat","jump","time","ride","car","home","plan","film","web"); //list of easy difficulty words
		$medium = array("candor","despot","emulate","program","brazen","caveat","poise","strength","strategy","verdict"); //list of normal difficulty words
		$hard = array("trepidation","mausoleum","insidious","incorrigible","vacillate","camaraderie","iridescent","magnitude","aberration","bombastic"); //list of hard difficulty words
		if ($diff == "easy") { //if submitted difficulty var was easy
			return str_split($easy[$i]); //return an easy word (as an array of letters) from index of easy array ($i is random 0-9 when the function is called)
		} else if ($diff == "normal") { //if diff is normal
			return str_split($medium[$i]); //return nommal word
		} else { //if diff is hard
			return str_split($hard[$i]); //return hard
		}
	}
	
	function getBlank ($word) { //function to get blank spaces (filled in with letters during the game)
		$blank = array(); //create array
		foreach ($word as $space) { //for each letter in the word
			$blank[] = '_'; //add a blank space, or an underline 
		}
		return $blank; //return array
	}
	
	function printArray($word) { //function to print the words/spaces in the game without print_r information
		foreach ($word as $val) { //for each letter in the word
			echo $val . ' '; //print letter, add a space for clarity, 
		}
	}
?>
