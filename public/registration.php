<?php
    /**
     * Registration Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Registration';
    $heading = 'Registration';

    // declaring empty array for errors
    $errors = [];

    // checking if form has submitted with POST request
    if ('POST' == $_SERVER['REQUEST_METHOD']) {

        // validating first name
        if(empty($_POST['first_name'])) {
            $errors['first_name'] = 'first name is a required field';
        } elseif(strlen($_POST['first_name']) < 3 || strlen($_POST['first_name']) > 50) {
            $errors['first_name'] = 'first name must be of minimum 3 characters or maximum of 50 characters';
        }

        // validating last name
        if(empty($_POST['last_name'])) {
            $errors['last_name'] = 'last name is a required field';
        } elseif(strlen($_POST['last_name']) < 3 || strlen($_POST['last_name']) > 50) {
            $errors['last_name'] = 'last name must be of minimum 3 characters or maximum of 50 characters';
        }

        // validating street
        if(empty($_POST['street'])) {
            $errors['street'] = 'street is a required field';
        } elseif(strlen($_POST['street']) < 3 || strlen($_POST['street']) > 100) {
            $errors['street'] = 'street must be of minimum 3 characters or maximum of 100 characters';
        }

        // validating city
        if(empty($_POST['city'])) {
            $errors['city'] = 'city is a required field';
        } elseif(strlen($_POST['city']) < 3 || strlen($_POST['city']) > 50) {
            $errors['city'] = 'city must be of minimum 3 characters or maximum of 50 characters';
        }

        // validating postal code
        if(empty($_POST['postal_code'])) {
            $errors['postal_code'] = 'postal code is a required field';
        } elseif(strlen($_POST['postal_code']) != 6) {
            $errors['postal_code'] = 'postal code must be of 6 characters';
        }

        // validating province
        if(empty($_POST['province'])) {
            $errors['province'] = 'province is a required field';
        } elseif(strlen($_POST['province']) < 2 || strlen($_POST['province']) > 50) {
            $errors['province'] = 'province must be of minimum 2 characters or maximum of 50 characters';
        }

        // validating country
        if(empty($_POST['country'])) {
            $errors['country'] = 'country is a required field';
        } elseif(strlen($_POST['country']) < 3 || strlen($_POST['country']) > 50) {
            $errors['country'] = 'country must be of minimum 3 characters or maximum of 50 characters';
        }

        // validating phone
        if(empty($_POST['phone'])) {
            $errors['phone'] = 'phone is a required field';
        } elseif(!filter_var($_POST['phone'], FILTER_VALIDATE_INT)) {
            $errors['phone'] = 'phone must be in digits';
        } elseif(strlen($_POST['phone']) != 10) {
            $errors['phone'] = 'phone must be of 10 characters';
        }

        // validating email
        if(empty($_POST['email'])) {
            $errors['email'] = 'email is a required field';
        } elseif(strlen($_POST['email']) < 8 || strlen($_POST['email']) > 100) {
            $errors['email'] = 'email must be of minimum 8 characters or maximum of 100 characters';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'please enter a valid email';
        }

        // validating password
        if(empty($_POST['password'])) {
            $errors['password'] = 'password is a required field';
        } elseif(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
            $errors['password'] = 'password must be of minimum 8 characters or maximum of 20 characters';
        }

        // validating confirm password
        if(empty($_POST['confirm_password'])) {
            $errors['confirm_password'] = 'confirm password is a required field';
        } elseif($_POST['password'] != $_POST['confirm_password']) {
            $errors['confirm_password'] = 'password and confirm password does not match';
        }

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
        
        <form id="registration" name="registration" method="post" action="<?=esc_attr($_SERVER['PHP_SELF'])?>" autocomplete="on" novalidate>
          <p>
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" class="form_control" name="first_name" placeholder="Enter your first name" value="<?=clean('first_name')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['first_name'])) : ?>
              <span class="error"><?=esc($errors['first_name'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" class="form_control" name="last_name" placeholder="Enter your last name" value="<?=clean('last_name')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['last_name'])) : ?>
              <span class="error"><?=esc($errors['last_name'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="street">Street</label>
            <input type="text" id="street" class="form_control" name="street" placeholder="Enter your street" value="<?=clean('street')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['street'])) : ?>
              <span class="error"><?=esc($errors['street'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="city">City</label>
            <input type="text" id="city" class="form_control" name="city" placeholder="Enter your city" value="<?=clean('city')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['city'])) : ?>
              <span class="error"><?=esc($errors['city'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" class="form_control" name="postal_code" placeholder="Enter your postal code" value="<?=clean('postal_code')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['postal_code'])) : ?>
              <span class="error"><?=esc($errors['postal_code'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="province">Province</label>
            <input type="text" id="province" class="form_control" name="province" placeholder="Enter your province" value="<?=clean('province')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['province'])) : ?>
              <span class="error"><?=esc($errors['province'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="country">Country</label>
            <input type="text" id="country" class="form_control" name="country" placeholder="Enter your country" value="<?=clean('country')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['country'])) : ?>
              <span class="error"><?=esc($errors['country'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="phone">Phone</label>
            <input type="text" id="phone" class="form_control" name="phone" placeholder="Enter your phone" value="<?=clean('phone')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['phone'])) : ?>
              <span class="error"><?=esc($errors['phone'])?></span>
            <?php endif; ?>
          </p>
          
          <p>
            <label for="email">Email</label>
            <input type="email" id="email" class="form_control" name="email" placeholder="Enter your email" value="<?=clean('email')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['email'])) : ?>
              <span class="error"><?=esc($errors['email'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="password">Password</label>
            <input type="password" id="password" class="form_control" name="password" placeholder="Enter your password" />
            <span class="required">*</span>
            <?php if(!empty($errors['password'])) : ?>
              <span class="error"><?=esc($errors['password'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" class="form_control" name="confirm_password" placeholder="Enter confirm password" />
            <span class="required">*</span>
            <?php if(!empty($errors['confirm_password'])) : ?>
              <span class="error"><?=esc($errors['confirm_password'])?></span>
            <?php endif; ?>
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