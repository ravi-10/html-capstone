<?php
    /**
     * Contact Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Contact';
    $heading = 'Contact Us';

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
        
        <form id="contact" name="contact" method="post" 
          action="http://www.scott-media.com/test/form_display.php" 
          autocomplete="on">
          <p>
            <label for="name">Name</label>
            <input type="text" id="name" class="form_control" name="name" 
              maxlength="50" placeholder="Enter your name" required />
            <span class="required">*</span>
          </p>
          
          <p>
            <label for="name">Email</label>
            <input type="email" id="email" class="form_control" name="email" 
              placeholder="Enter your email" required />
            <span class="required">*</span>
          </p>
          
          <p>
            <label for="travel_preference">Travel Preference</label>
            <select name="travel_preference" id="travel_preference" 
              class="form_control">
              <option value="">Select Preference</option>
              <option value="solo">Solo</option>
              <option value="group">Group</option>
              <option value="both">Both</option>
            </select>
          </p>
          
          <p>
            <label for="subject">Subject</label>
            <input type="text" id="subject" class="form_control" name="subject" 
              placeholder="Enter subject" required />
            <span class="required">*</span>
          </p>
          
          <p>
            <label id="msg" for="name" style="vertical-align: top;">Message</label>
            <textarea name="message" id="message" class="form_control" required></textarea>
            <span class="required">*</span>
          </p>
          
          <p id="form_buttons">
            <input type="submit" class="button" value="Send" /> 
            <input type="reset" class="button" /> 
          </p>
        </form>
        
        <img id="map" src="images/map.jpg" alt="map">
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>