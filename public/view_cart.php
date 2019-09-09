<?php
	/**
     * View Cart Page
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';
    //require 'cart_config.php';

    $title = 'ATG - View Cart';
    $heading = 'View Cart';

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
          <caption>Added Tour(s)</caption>
          <tr>
            <th>Tour</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Line Price</th>
            <th>Action</th>
          </tr>
          
          <?php foreach ($_SESSION['cart'] as $cart) : ?>
            <tr>
              <td><?=esc($cart['title'])?></td>
              <td><?=esc($cart['price'])?></td>
              <td><?=esc($cart['quantity'])?></td>
              <td>
                <?=esc(getLineTotal($cart['price'], $cart['quantity']))?>
              </td>
              <td>
                <form action="remove_from_cart.php" method="post">
                  <input type="hidden" name="tour_id" value="<?=esc_attr($cart['tour_id'])?>">
                  <button type="submit">Remove Tour</button>
              </form>
              </td>
            </tr>
          <?php endforeach; ?>

        </table>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>