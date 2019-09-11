<?php
	/**
     * View Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - View Cart';
    $heading = 'View Cart';

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

        <div class="flash <?=$_SESSION['flash_class']?>">
            <?php require __DIR__ . '/../inc/flash.inc.php'; ?>
        </div>
        
        <table id="cart_details">
          <caption>Added Tour(s)</caption>
          <tr>
            <th>Tour</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Line Price</th>
            <th>Action</th>
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
                    $sub_total_price += getLineTotal($cart['price'], 
                                                      $cart['quantity']);
                    $sub_total_qty += $cart['quantity'];
                ?>
                <?=esc(number_format(getLineTotal($cart['price'], $cart['quantity']), 2))?>
              </td>
              <td>
                <form action="remove_from_cart.php" method="post">
                  <input type="hidden" name="tour_id" 
                    value="<?=esc_attr($cart['tour_id'])?>">
                  <select name="quantity">
                    <?php
                      $max = $cart['quantity'];
                      for ($i=$max; $i >= 1 ; $i--) :
                    ?>
                      <option value="<?=esc_attr($i)?>"><?=esc($i)?></option>
                    <?php endfor; ?>
                  </select>
                  <button type="submit" class="remove">Remove Tour</button>
              </form>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr class="total">
            <td></td>
            <td>Sub Total</td>
            <td><?=esc($sub_total_qty)?></td>
            <td><?=esc($sub_total_price)?></td>
            <td></td>
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

          <tr class="checkout">
            <td colspan="5">
              <a class="continue_booking" 
              href="tours.php">Continue Booking</a>
              <a href="checkout.php">Checkout Now</a>
            </td>
          </tr>

        <?php else : ?>
          <tr class="">
            <td colspan="5">
              There is no tour in cart. <a class="continue_booking" 
              href="tours.php">Continue Booking</a>
            </td>
          </tr>          
        <?php endif; ?>

        </table>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>