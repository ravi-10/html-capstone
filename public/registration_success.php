<?php
	/**
     * Registration Success Page
     * last_update: 2019-08-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Registration Success';
    $heading = 'Thank you for registering!';

    // if there is no user_id in GET request we will stop execution
	if(empty($_GET['user_id'])) {
		die('Go back and <a href="registration.php">register</a>');
	}

	// query to get details of specific user
	$query = "SELECT
				first_name, last_name, street, city, postal_code, province, country, phone, email
				FROM users WHERE user_id = :user_id";

	// prepare the query
	$stmt = $dbh->prepare($query);

	// parameters array for placeholders
	$params = [':user_id' => (int) $_GET['user_id']];

	// execute the query
	$stmt->execute($params);

	// fetch the result
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	// including head file
    require '../inc/head.inc.php';

    // including header file
    require '../inc/header.inc.php';

?>

	<main>
        <div id="hero">
          <img src="images/banner.jpg" alt="banner image">
          <div>
            <h1><?=esc($heading)?></h1>
          </div>
        </div>

        <p class="reg_success">You submitted the following information:</p>

        <ul>
        	<?php foreach ($result as $key => $value) : ?>
        		<li>
        			<span class="key"><?=ucwords(str_replace('_', ' ', $key))?> :</span>
        			<span class="value"><?=$value?></span>
        		</li>
        	<?php endforeach; ?>
        </ul>
    </main>
      
	<?php
	    // including footer file
	    require '../inc/footer.inc.php';
	?>