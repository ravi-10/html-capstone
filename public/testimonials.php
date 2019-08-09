<?php
    /**
     * Testimonials Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Testimonials';
    $heading = 'Testimonials';

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
        
        <div class="testimonial">
          <h2>Animi quam dolor vero aperiam</h2>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt iure, nisi perferendis. Culpa quaerat tenetur eum enim laudantium esse consequuntur voluptate inventore, expedita, atque, repudiandae odit tempora sed quas repellendus? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum. Facere esse quis eius sapiente sunt ad eos quod!</p>
            <span>- Christopher Gardner</span>
          </div>
        </div>
        
        <div class="testimonial">
          <h2>Eos maxime ciendis.</h2>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt iure, nisi perferendis. Culpa quaerat tenetur eum enim laudantium esse consequuntur voluptate inventore, expedita, atque, repudiandae odit tempora sed quas repellendus? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum. Facere esse quis eius sapiente sunt ad eos quod!</p>
            <span>- Jay Twistle</span>
          </div>
        </div>
        
        <div class="testimonial">
          <h2>Animi quam dolor vero aperiam</h2>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt iure, nisi perferendis. Culpa quaerat tenetur eum enim laudantium esse consequuntur voluptate inventore, expedita, atque, repudiandae odit tempora sed quas repellendus? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis blanditiis provident est quas, totam vitae quo quibusdam magni esse, perspiciatis dolorum. Facere esse quis eius sapiente sunt ad eos quod!</p>
            <span>- Walter Ribbon</span>
          </div>
        </div>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>