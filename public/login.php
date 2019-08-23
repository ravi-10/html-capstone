<?php
    /**
     * Login Page 
     * last_update: 2019-08-23
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    // Listing class dependency with USE statements
    use App\Validator;

    $title = 'ATG - Login';
    $heading = 'Login';

    // declaring empty array for errors
    $errors = [];

    // checking if form has submitted with POST request
    if ('POST' == $_SERVER['REQUEST_METHOD']) {

        // Instantiating object of Validator class
        $v = new Validator;

        foreach ($_POST as $key => $value) {
            // calling required function for all fields
            $v->required($key);
        }
        
        $v->email('email');

        $errors = $v->getErrors();

        // checking if there is no errors before login
        if(empty($errors)) {

            // login

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
        
        <form id="login" name="login" method="post" action="<?=esc_attr($_SERVER['PHP_SELF'])?>" autocomplete="on" novalidate>
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
          
          <p id="form_buttons">
            <input type="submit" class="button" value="Login" />
            <input type="reset" class="button" />
          </p>

          <p class="center">
            Not a member yet? <a href="registration.php">Register Now!</a>
          </p>
        </form>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>