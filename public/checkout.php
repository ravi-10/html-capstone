<?php
	/**
     * View Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';
    //require 'cart_config.php';

    $title = 'ATG - Checkout';
    $heading = 'Checkout';

    if(!$_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You must be logged in to view cart page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: login.php');
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
            <td><?=esc($sub_total_price)?></td>
          </tr>

          <tr class="total">
            <td></td>
            <td>GST</td>
            <td></td>
            <td><?=esc(number_format(getGST($sub_total_price), 2))?></td>
            <td></td>
          </tr>

          <tr class="total">
            <td></td>
            <td>PST</td>
            <td></td>
            <td><?=esc(number_format(getPST($sub_total_price), 2))?></td>
            <td></td>
          </tr>

          <tr class="total">
            <td></td>
            <td>Total</td>
            <td></td>
            <td><?=esc(number_format(getTotal($sub_total_price), 2))?></td>
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
            <input type="text" id="card_number" class="form_control" name="card_number" placeholder="Enter card number" />
            <span class="required">*</span>
            <?php if(!empty($errors['card_number'])) : ?>
              <span class="error"><?=esc($errors['card_number'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="expiry_date">Expiry Date</label>
            <input type="text" id="expiry_date" class="form_control" name="expiry_date" placeholder="Enter expiry date" />
            <span class="required">*</span>
            <?php if(!empty($errors['expiry_date'])) : ?>
              <span class="error"><?=esc($errors['expiry_date'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" class="form_control" name="cvv" placeholder="Enter cvv" />
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