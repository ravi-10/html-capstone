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

    if(!empty($_GET['logout'])) {
        logout();
    }

    $request_from = "";
    if(!empty($_GET['request_from'])){
      $request_from = $_GET['request_from'];
    }

    if($_SESSION['logged_in']) {
        $_SESSION['flash'] = 'You are already logged in!';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: profile.php');
        exit;
    }

    // declaring empty array for errors
    $errors = [];

    // checking if form has submitted with POST request
    if ('POST' == $_SERVER['REQUEST_METHOD']) {

        // validate every POST submission for the csrf token
        if(empty($_POST['csrf']) || $_POST['csrf'] != $_SESSION['csrf']) {
            $_SESSION['flash'] = "Your session appears to have expired. 
                                  CSRF token mismatch! Please log in again.";
            $_SESSION['flash_class'] = 'flash-alert';
            header('Location: login.php');
            die;
        }

        // Instantiating object of Validator class
        $v = new Validator;

        foreach ($_POST as $key => $value) {
            if($key != 'request_from') {
                // calling required function for all fields
                $v->required($key);
            }
        }
        
        $v->email('email');

        $errors = $v->getErrors();

        // checking if there is no errors before login
        if(empty($errors)) {

            $query = 'SELECT user_id, first_name, password FROM users 
                      WHERE email = :email';

            $stmt = $dbh->prepare($query);

            $params = array(
                ':email' => $_POST['email']
            );

            $stmt->execute($params);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user) {

              if(password_verify($_POST['password'], $user['password'])) {
                  $_SESSION['logged_in'] = true;
                  $_SESSION['user_id'] = $user['user_id'];
                  $_SESSION['flash'] = "Welcome Back, {$user['first_name']}! 
                                        You have successfully logged in.";
                  $_SESSION['flash_class'] = 'flash-success';
                  session_regenerate_id(true);
                  if(!empty($_POST['request_from'])){
                      header('Location: ' . $_POST['request_from']);
                  } else {
                      header('Location: profile.php');
                  }
                  die;
                  
              } else {
                  unset($_SESSION['logged_in']);
                  $errors['credentials'] = "Login credentials do not match";
              }
              
            } else {
                unset($_SESSION['logged_in']);
                $errors['credentials'] = "Login credentials do not match";
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
        
        <form id="login" name="login" method="post" 
          action="<?=esc_attr($_SERVER['PHP_SELF'])?>" autocomplete="on" 
          novalidate>
          <input type="hidden" name="csrf" 
            value="<?=esc_attr(csrf())?>" />
          <input type="hidden" name="request_from" 
            value="<?=esc_attr($request_from)?>">

          <p>
            <?php if(!empty($errors['credentials'])) : ?>
              <span class="error"><?=esc($errors['credentials'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="email">Email</label>
            <input type="email" id="email" class="form_control" name="email" 
              placeholder="Enter your email" value="<?=clean('email')?>" />
            <span class="required">*</span>
            <?php if(!empty($errors['email'])) : ?>
              <span class="error"><?=esc($errors['email'])?></span>
            <?php endif; ?>
          </p>

          <p>
            <label for="password">Password</label>
            <input type="password" id="password" class="form_control" 
              name="password" placeholder="Enter your password" />
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