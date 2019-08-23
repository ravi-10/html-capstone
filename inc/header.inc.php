<?php
    /**
     * Header Include Page 
     * last_update: 2019-08-23
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
?>
<header>
  <div id="utility_nav">
    <div id="socials">
      <a href="#"><img src="images/pinterest-32.png" alt="pinterest"></a>
      <a href="#"><img src="images/instagram-32.png" alt="instagram"></a>
      <a href="#"><img src="images/youtube-32.png" alt="youtube"></a>
      <a href="#"><img src="images/twitter-32.png" alt="twitter"></a>
      <a href="#"><img src="images/facebook-32.png" alt="facebook"></a>
    </div>
    <div id="top_links">
      <a href="#">FAQs</a>
      <?php if($_SESSION['logged_in']) : ?>
        <a href="profile.php">Profile</a>
        <a href="login.php?logout=1">Logout</a>
      <?php else : ?>
        <a href="login.php">Login</a>
        <a href="registration.php">Register</a>
      <?php endif; ?>
    </div>
  </div>
  
  <?php
      // including nav file
      require 'nav.inc.php';
  ?>
</header>