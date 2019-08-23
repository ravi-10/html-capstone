<?php
    /**
     * Registration Page 
     * last_update: 2019-08-23
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    // Listing class dependency with USE statements
    use App\Validator;

    $title = 'ATG - Registration';
    $heading = 'Registration';

    // declaring empty array for errors
    $errors = [];

    // checking if form has submitted with POST request
    if ('POST' == $_SERVER['REQUEST_METHOD']) {

        // Instantiating object of Validator class
        $v = new Validator;

        foreach ($_POST as $key => $value) {
            // calling required function for all fields
            $v->required($key);

            // calling general functions for specific fields
            if ($key == 'first_name' || $key == 'last_name' || $key == 'city' || 
              $key == 'province' || $key == 'country') {
                $v->generalStringValidator($key);
                $v->generalLengthValidator($key);
            }
        }
        
        $v->street('street');
        $v->postalCode('postal_code');
        $v->phone('phone');
        $v->email('email');
        $v->passwordValidator('password', 'confirm_password');

        $errors = $v->getErrors();

        // checking if there is no errors before inserting a record
        if(empty($errors)) {

            // create the query
            $query = 'INSERT INTO
                        users
                        (first_name, last_name, street, city, postal_code, province,
                        country, phone, email, password)
                        VALUES
                        (:first_name, :last_name, :street, :city, :postal_code, :province,
                        :country, :phone, :email, :password)';

            // prepare the query
            $stmt = $dbh->prepare($query);

            // parameters array for placeholders
            $params = array(
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':street' => $_POST['street'],
                ':city' => $_POST['city'],
                ':postal_code' => $_POST['postal_code'],
                ':province' => $_POST['province'],
                ':country' => $_POST['country'],
                ':phone' => $_POST['phone'],
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            );

            // execute the query
            $stmt->execute($params);

            // get the ID of the record we just inserted
            $id = $dbh->lastInsertId();

            // if insert is successful
            if($id) {
                // redirect to new page (PRG: Post Redirect Get)
                header('Location: registration_success.php?user_id=' . $id);
                exit;
            } else {
                $errors[] = "There was a problem adding the record";
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

          <p class="center">
            Already have an account? <a href="login.php">Login Now!</a>
          </p>
        </form>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>