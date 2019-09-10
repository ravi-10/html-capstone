<?php
	/**
     * Remove from Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    if(!$_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You must be logged in to remove from cart.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: login.php');
        exit;
    }

	if(!empty($_POST['quantity'])){
        $quantity_in_cart = $_SESSION['cart'][$_POST['tour_id']]['quantity'];
        $quantity_to_remove = $_POST['quantity'];

        $updated_quantity = $quantity_in_cart - $quantity_to_remove;

        if($updated_quantity == 0){
            unset($_SESSION['cart'][$_POST['tour_id']]);
        } else {
            $_SESSION['cart'][$_POST['tour_id']]['quantity'] = $updated_quantity;
        }

		header('Location: view_cart.php');
		die;
	}