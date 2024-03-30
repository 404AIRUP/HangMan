<?php
	function getWord ($diff, $i) {
		$easy = array("good","boat","jump","time","ride","car","home","plan","film","web");
		$medium = array("candor","despot","emulate","program","brazen","caveat","poise","strength","strategy","verdict");
		$hard = array("trepidation","mausoleum","insidious","incorrigible","vacillate","camaraderie","iridescent","magnitude","aberration","bombastic");
		if ($diff == "easy") {
			return str_split($easy[$i]);
		} else if ($diff == "normal") {
			return str_split($medium[$i]);
		} else {
			return str_split($hard[$i]);
		}
	}
	
	function getBlank ($word) {
		$blank = array();
		foreach ($word as $space) {
			$blank[] = '_';
		}
		return $blank;
	}
	
	function printArray($word) {
		foreach ($word as $val) {
			echo $val . ' ';
		}
	}
?>