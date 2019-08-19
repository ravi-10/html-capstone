<?php
    /**
     * Main Navigation Include Page 
     * last_update: 2019-08-19
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
?>
<div id="main_nav">
  <img id="logo" src="images/logo.png" alt="logo">
  <nav>
    <a id="menu-toggle" href="#navlist"><img src="images/menu-white.png" alt="menu toggle" /></a>
    <ul>
      <li><a href="index.php" <?= ($title=='Around The Globe') ? 'class="current"' : ''; ?> title="Home">Home</a></li>
      <li><a href="tours.php" <?= ($title=='ATG - Tours') ? 'class="current"' : ''; ?> title="Tours">Tours</a></li>
      <li><a href="about.php" <?= ($title=='ATG - About') ? 'class="current"' : ''; ?> title="About">About Us</a></li>
      <li><a href="blog.php" <?= ($title=='ATG - Blog') ? 'class="current"' : ''; ?> title="Blog">Blog</a></li>
      <li><a href="testimonials.php" <?= ($title=='ATG - Testimonials') ? 'class="current"' : ''; ?> title="Testimonials">Testimonials</a></li>
      <li><a href="contact.php" <?= ($title=='ATG - Contact') ? 'class="current"' : ''; ?> title="Contact Us">Contact Us</a></li>
    </ul>
  </nav>
</div>