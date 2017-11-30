<?php
	
	
	session_start();
	include 'resource/logincheck.php';
	die(header('Location: resource/index.php'));

?>
