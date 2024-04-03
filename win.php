<?php
if(!(isset($_SESSION['name'])) || ($_SESSION['rounds'] != 6)){ 
	header("location:start.php");
	exit;
}
?>