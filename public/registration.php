<?php
    /**
     * Registration Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Registration';
    $heading = 'Registration';

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
        
        <form id="registration" name="registration" method="post" action="<?=esc_attr($_SERVER['PHP_SELF'])?>" autocomplete="on" novalidate>
          <p>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" class="form_control" name="first_name" placeholder="Enter your first name" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" class="form_control" name="last_name" placeholder="Enter your last name" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="street">Street</label>
            <input type="text" id="street" class="form_control" name="street" placeholder="Enter your street" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="city">City</label>
            <input type="text" id="city" class="form_control" name="city" placeholder="Enter your city" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" class="form_control" name="postal_code" placeholder="Enter your postal code" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="province">Province</label>
            <input type="text" id="province" class="form_control" name="province" placeholder="Enter your province" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="country">Country</label>
            <input type="text" id="country" class="form_control" name="country" placeholder="Enter your country" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="phone">Phone</label>
            <input type="text" id="phone" class="form_control" name="phone" placeholder="Enter your phone" />
            <span class="required">*</span>
          </p>
          
          <p>
            <label for="email">Email</label>
            <input type="email" id="email" class="form_control" name="email" placeholder="Enter your email" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="password">Password</label>
            <input type="password" id="password" class="form_control" name="password" placeholder="Enter your password" />
            <span class="required">*</span>
          </p>

          <p>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" class="form_control" name="confirm_password" placeholder="Enter confirm password" />
            <span class="required">*</span>
          </p>
          
          <p id="form_buttons">
            <input type="submit" class="button" value="Register" />
            <input type="reset" class="button" />
          </p>
        </form>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>