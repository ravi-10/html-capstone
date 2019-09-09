<?php
	/**
     * Add to Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\TourModel;

    if(!$_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You must be logged in to add to cart.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: login.php');
        exit;
    }

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	if(!empty($_POST)){
		$item = array(
			'tour_id' => $_POST['tour_id'],
			'quantity' => $_POST['quantity']
		);
		
		// get $item i.e. tour data and store
		$obj_tour = new TourModel;
	    $tour_details = $obj_tour->one($item['tour_id']);

	    $_SESSION['cart'][$item['tour_id']] = $tour_details;
	    $_SESSION['cart'][$item['tour_id']]['quantity'] = $item['quantity'];

		$_SESSION['flash'] = 'Tour was successfully added to shopping cart';
		$_SESSION['flash_class'] = 'flash-success';

		header('Location: tours.php');
		die;
	}