<?php
/**
     * Test Tour Model Page 
     * last_update: 2019-08-26
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    // Listing class dependency with USE statements
    use App\Model;
    use App\TourModel;

    Model::init($dbh);

    $tour = new TourModel;
    //dd($tour->all());

    dd($tour->one(21));

    $tour_array = array();
    $title = 'My tour';
    $category_id = 1;
    $featured_image = 'images/featured.jpg';
    $thumbnail_image = 'images/thumb.jpg';
    $description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
	$country = 'Canada';
	$from_date = '2019-09-15';
	$to_date = '2019-09-21';
	$price = 450.00;
	$booking_ends = '2019-09-02';
	$max_allowed_bookings = 5;

	$tour_array['title'] = $title;
	$tour_array['category_id'] = $category_id;
	$tour_array['featured_image'] = $featured_image;
	$tour_array['thumbnail_image'] = $thumbnail_image;
	$tour_array['description'] = $description;
	$tour_array['country'] = $country;
	$tour_array['from_date'] = $from_date;
	$tour_array['to_date'] = $to_date;
	$tour_array['price'] = $price;
	$tour_array['booking_ends'] = $booking_ends;
	$tour_array['max_allowed_bookings'] = $max_allowed_bookings;

	//var_dump($tour_array);

	//dd($tour->saveTour($tour_array));