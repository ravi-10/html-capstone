<?php
	/**
     * Configuration File 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */

	// Setting error display and reporting level
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);

	// Setting Database Credentials
	define('DB_DSN', 'mysql:host=localhost;dbname=atg_tours');
	// remember to ensure the defined user is exists and has access to the required db
	define('DB_USER', 'root');
	define('DB_PASS', '');

	// Creating DB connection
	$dbh = new PDO(DB_DSN, DB_USER, DB_PASS);
	// Setting the $dbh to display errors if there are any
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// including functions file
	require 'functions.php';