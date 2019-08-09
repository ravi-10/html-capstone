<?php
    /**
     * Home Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'Around The Globe';

    // including head file
    require '../inc/head.inc.php';

    // including header file
    require '../inc/header.inc.php';
?>
      
      <main>
        <div id="hero">
          <img src="images/hero_image.jpg" alt="hero image">
          <div id="cta">
            <h1>An Evening in Paris</h1>
            <p>Sed lacinia, libero at accumsan blandit, erat lorem venenatis purus, vitae laoreet urna felis eget risus. Donec elementum ex sit.</p>
            <a href="#">Book Now</a>
          </div>
        </div>
        
        <div id="upcoming_tours">
          <h2>Upcoming Tours</h2>
          <div class="tour">
            <div class="title">
              <h3>Amsterdam</h3>
              <span>April 20 - April 27</span>
            </div>
            <div class="tour_image">
              <img src="images/amsterdam.jpg" alt="amsterdam">
            </div>
            <div class="description">
              <p>
                Donec vel nisi ut libero hendrerit facilisis. Etiam lobortis lacus vel pretium rhoncus. In imperdiet efficitur purus, id libero varius lacus vel eros varius vel.
              </p>
              <a href="#">Read More</a>
            </div>
          </div>
          
          <div class="tour">
            <div class="title">
              <h3>Ibiza</h3>
              <span>May 12 - May 17</span>
            </div>
            <div class="tour_image">
              <img src="images/ibiza.jpg" alt="ibiza">
            </div>
            <div class="description">
              <p>
                Phasellus laoreet fermentum lectus, vitae ultricies ante malesuada at. Proin mattis consequat gravida. Nulla eleifend mattis arcu vel pellentesque.
              </p>
              <a href="#">Read More</a>
            </div>
          </div>
          
          <div class="tour">
            <div class="title">
              <h3>Bali</h3>
              <span>June 15 - June 23</span>
            </div>
            <div class="tour_image">
              <img src="images/bali.jpg" alt="bali">
            </div>
            <div class="description">
              <p>
                Aliquam sagittis ac felis pretium vestibulum. In id mauris vitae libero bibendum sagittis. Pellentesque vel neque a purus tincidunt tincidunt.
              </p>
              <a href="#">Read More</a>
            </div>
          </div>
        </div>
        
        <div id="recent_blogs">
          <h2>Recent Blogs</h2>
          <div class="blog">
            <img src="images/trip_tips.jpg" alt="tips to plan a trip">
            <div class="overlay">
              <a href="#">Tips to plan a trip</a>
            </div>
          </div>
          <div class="blog">
            <img src="images/explore_switzerland.jpg" alt="explore switzerland">
            <div class="overlay">
              <a href="#">Explore Switzerland</a>
            </div>
          </div>
          <div class="blog" id="blog_read_more">
            <div class="overlay">
              <a href="#">More...</a>
            </div>
          </div>
        </div>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>