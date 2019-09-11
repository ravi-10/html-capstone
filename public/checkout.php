<?php
	/**
     * View Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';
    use App\Validator;
    use App\BookingModel;

    $title = 'ATG - Checkout';
    $heading = 'Checkout';

    if(!$_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You must be logged in to view cart page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: login.php');
        exit;
    }

    if(empty($_SESSION['cart'])) {
        $_SESSION['flash'] = 'There is no tour in cart, please add tour(s) in cart to checkout.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: tours.php');
        exit;
    }

    if ('POST' == $_SERVER['REQUEST_METHOD']) {

        // validate every POST submission for the csrf token
        if(empty($_POST['csrf']) || $_POST['csrf'] != $_SESSION['csrf']) {
            $_SESSION['flash'] = "Your session appears to have expired. 
                                  CSRF token mismatch! Please try again.";
            $_SESSION['flash_class'] = 'flash-alert';
            header('Location: checkout.php');
            die;
        }

        // Instantiating object of Validator class
        $v = new Validator;

        foreach ($_POST as $key => $value) {
            // calling required function for all fields
            $v->required($key);
        }

        $v->generalStringValidator('name');
        $v->numbersOnly('card_number');
        $v->dateFormat('expiry_date');
        $v->numbersOnly('cvv');

        $errors = $v->getErrors();

        // checking if there is no errors before inserting a record
        if(empty($errors)) {

          $b = new BookingModel;
          try {
              $dbh->beginTransaction();

              $booking_id = $b->saveBooking($_POST);
              if($booking_id > 0) {
                  $inserted_rows = $b->saveBookingLineItems($booking_id);
                  if($inserted_rows > 0) {
                      $dbh->commit();
                      header('Location: thank_you.php?booking_id=' . $booking_id);
                      die;
                  }
              }
          } catch (PDOException $e) {
            $dbh->rollback();
            throw $e;
          }


        } // endif

    } // end of POST

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

        <div class="flash <?=$_SESSION['flash_class']?>">
            <?php require __DIR__ . '/../inc/flash.inc.php'; ?>
        </div>
        
        <table id="cart_details">
          <caption>Booked Tour(s)</caption>
          <tr>
            <th>Tour</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Line Price</th>
          </tr>
          <?php if(!empty($_SESSION['cart'])) : ?>
          <?php
            $sub_total_qty = 0;
            $sub_total_price = 0;
          ?>
          <?php foreach ($_SESSION['cart'] as $cart) : ?>
            <tr>
              <td><?=esc($cart['title'])?></td>
              <td><?=esc($cart['price'])?></td>
              <td><?=esc($cart['quantity'])?></td>
              <td>
                <?php
                    $sub_total_price += getLineTotal($cart['price'], $cart['quantity']);
                    $sub_total_qty += $cart['quantity'];
                ?>
                <?=esc(number_format(getLineTotal($cart['price'], $cart['quantity']), 2))?>
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

        <?php else : ?>
          <tr class="">
            <td colspan="5">
              There is no tour in cart
            </td>
          </tr>          
        <?php endif; ?>

        </table>

        <form id="payment" name="payment" method="post" action="<?=esc_attr($_SERVER['PHP_SELF'])?>" autocomplete="on" novalidate>
          <h2>Payment Information</h2>
          <input type="hidden" name="csrf" value="<?=esc_attr(csrf())?>" />
          <input type="hidden" name="sub_total" value="<?=esc_attr($sub_total_price)?>">
          <input type="hidden" name="gst" value="<?=esc_attr($calculated_gst)?>">
          <input type="hidden" name="pst" value="<?=esc_attr($calculated_pst)?>">
          <input type="hidden" name="total" value="<?=esc_attr($calculated_total)?>">

          <p>
            <label for="name">Name on Card</label>
            <input type="text" id="name" class="form_control" name="name" placeholder="Enter name on card" value="<?=clean('name')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['name'])) : ?>
              <span class="error"><?=esc($errors['name'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="card_number">Credit Card Number</label>
            <input type="text" id="card_number" class="form_control" name="card_number" placeholder="Enter card number" value="<?=clean('card_number')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['card_number'])) : ?>
              <span class="error"><?=esc($errors['card_number'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="expiry_date">Expiry Date</label>
            <input type="text" id="expiry_date" class="form_control" name="expiry_date" placeholder="Enter expiry date" value="<?=clean('expiry_date')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['expiry_date'])) : ?>
              <span class="error"><?=esc($errors['expiry_date'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" class="form_control" name="cvv" placeholder="Enter cvv" value="<?=clean('cvv')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['cvv'])) : ?>
              <span class="error"><?=esc($errors['cvv'])?></span>
            <?php endif; ?>
          </p>
          
          <p id="form_buttons">
            <input type="submit" class="button" value="Pay Now" />
            <input type="reset" class="button" />
          </p>

          <p class="center">
            <a href="tours.php">Continue Booking</a>
          </p>
        </form>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>