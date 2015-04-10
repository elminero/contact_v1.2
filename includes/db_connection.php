<?php 
	define("DB_SERVER", "localhost");
	define("DB_USER", "ian");
	define("DB_PASS", "super1964");
	define("DB_NAME", "contacts");
		
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if(mysqli_connect_errno()){
		die("Database connection failed. " . mysqli_connect_error() . ": " . mysqli_connect_errno());	
	}