<?php
	/**
     * Registration Success Page
     * last_update: 2019-08-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    // if there is no user_id in GET request we will stop execution
	if(empty($_GET['user_id'])) {
		die('Go back and <a href="registration.php">register</a>');
	}

	echo $_GET['user_id'];