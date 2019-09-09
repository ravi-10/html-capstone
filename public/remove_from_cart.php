<?php
	/**
     * Remove from Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

	if(!empty($_POST)){
		
		unset($_SESSION['cart'][$_POST['tour_id']]);

		header('Location: view_cart.php');
		die;
	}