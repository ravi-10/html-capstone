<?php
	/**
     * Thank You Page
     * last_update: 2019-09-10
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';
    use App\BookingModel;
    use App\UserModel;

    $title = 'ATG - Thank You';
    $heading = 'Thank You for Booking!';

    if(!$_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You must be logged in and pay for booking to 
                                view payment details page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: login.php');
        exit;
    }

    if(!empty($_GET['booking_id'])){
    	$obj_booking = new BookingModel;
    	$obj_user = new UserModel;

	    $booking = $obj_booking->one($_GET['booking_id']);

	    $booking_line_items = $obj_booking->getLineItems($booking['booking_id']);

	    $user = $obj_user->one($_SESSION['user_id']);
	    	    
    } else {
    	$_SESSION['flash'] = 'Please make a payment to see the thank you page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: checkout.php');
        exit;
    }

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
        
        <div class="booking-info">
        	<h2>Booking Info</h2>
        	<span>
        		<span>Booking #: </span>
        		<strong class="value">
              <?=esc('10000' . $booking['booking_id'])?>
            </strong>
        	</span>
        	<br>
        	<span>
        		<span>Date Time: </span>
        		<strong class="value"><?=esc($booking['created_at'])?></strong>
        	</span>
        	<br>
        	<span>
        		<span>Charged: </span>
        		<strong class="value"><?=esc($booking['total'])?></strong>
        	</span>
        	<br>
        	<span>
        		<span>Addressed: </span>
        		<strong class="value"><?=esc($booking['customer_address'])?></strong>
        	</span>
        </div>

        <div class="company-user">
        	<div class="company-info">
        		<h2>Company Info</h2>
        		<span>
	        		<strong class="value">Around The Globe</strong>
	        	</span>
	        	<br>
	        	<span>
	        		<strong class="value"></strong>
	        		<span></span>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Queries about your order:</span>
	        	</span>
	        	<br>
	        	<span>
	        		<strong class="value"></strong>
	        		<span></span>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Tel: </span>
	        		<strong class="value">1-800-555-7722</strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Email: </span>
	        		<strong class="value">orders@atg.com</strong>
	        	</span>
	        	<br>
	        	<span>
	        		<strong class="value"></strong>
	        		<span></span>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Have a nice day!</span>
	        	</span>
        	</div>
        	<div class="user-info">
        		<h2>User Info</h2>
        		<span>
	        		<span>Name: </span>
	        		<strong class="value">
	        			<?=esc($user['first_name'] . ' ' . $user['last_name'])?>
	        		</strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Street: </span>
	        		<strong class="value"><?=esc($user['street'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>City: </span>
	        		<strong class="value"><?=esc($user['city'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Province: </span>
	        		<strong class="value"><?=esc($user['province'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Postal Code: </span>
	        		<strong class="value"><?=esc($user['postal_code'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Country: </span>
	        		<strong class="value"><?=esc($user['country'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Phone: </span>
	        		<strong class="value"><?=esc($user['phone'])?></strong>
	        	</span>
	        	<br>
	        	<span>
	        		<span>Email: </span>
	        		<strong class="value"><?=esc($user['email'])?></strong>
	        	</span>
        	</div>
        </div>

        <table id="booking_details">
          <caption>Booking Details</caption>
          <tr>
            <th>Tour</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Line Price</th>
          </tr>
          <?php
            $sub_total_qty = 0;
            $sub_total_price = 0;
          ?>
          <?php foreach ($booking_line_items as $line_item) : ?>
      		<tr>
              <td><?=esc($line_item['title'])?></td>
              <td><?=esc($line_item['unit_price'])?></td>
              <td><?=esc($line_item['quantity'])?></td>
              <td>
                <?php
                    $sub_total_price += getLineTotal($line_item['unit_price'], $line_item['quantity']);
                    $sub_total_qty += $line_item['quantity'];
                ?>
                <?=esc(number_format(getLineTotal($line_item['unit_price'], $line_item['quantity']), 2))?>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr class="total">
            <td></td>
            <td>Sub Total</td>
            <td><?=esc($sub_total_qty)?></td>
            <td>
              <?php
                $calculated_sub_total = number_format($sub_total_price, 2);
                echo esc($calculated_sub_total);
              ?>
            </td>
          </tr>

          <tr class="total">
            <td></td>
            <td>GST</td>
            <td></td>
            <td>
              <?php
                $calculated_gst = number_format(getGST($sub_total_price), 2);
                echo esc($calculated_gst);
              ?>
            </td>
            <td></td>
          </tr>

          <tr class="total">
            <td></td>
            <td>PST</td>
            <td></td>
            <td>
              <?php
                $calculated_pst = number_format(getPST($sub_total_price), 2);
                echo esc($calculated_pst);
              ?>
            </td>
            <td></td>
          </tr>

          <tr class="total">
            <td></td>
            <td>Total</td>
            <td></td>
            <td>
              <?php
                $calculated_total = number_format(getTotal($sub_total_price), 2, '.', '');
                echo esc($calculated_total);
              ?>
              </td>
            <td></td>
          </tr>

        </table>

      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>