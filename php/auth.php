<?php
// Defining global session variables to identify logged in user
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: ./php/login.php");
		exit();
	}
	if(!isset($_SESSION["authid"])){
		header("Location: ./php/login.php");
		exit();
	}
		if(!isset($_SESSION["groupid"])){
		header("Location: ./php/login.php");
		exit();
	}
?>