<?php
    /**
     * Tours Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Tours';
    $heading = 'Tours';

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
        
        <div class="tour_container">
          <div class="tour_box left">
            <div class="img">
              <img src="images/france.jpg" alt="france">
              <span class="rate">$5,000</span>
              <span class="more"><a href="#">More Info..</a></span>
            </div>
            <div class="description">
              <h2>France</h2>
              <p>April 20 - April 30</p>
              <ul>
                <li>Visit the city</li>
                <li>Try local cuisine</li>
                <li>Know history of the city</li>
                <li>Visit museums</li>
              </ul>
            </div>
          </div>

          <div class="tour_box right">
            <div class="img">
              <img src="images/berlin.jpg" alt="berlin">
              <span class="rate">$4,500</span>
              <span class="more"><a href="#">More Info..</a></span>
            </div>
            <div class="description">
              <h2>Berlin</h2>
              <p>May 05 - May 11</p>
              <ul>
                <li>Visit the city</li>
                <li>Try local cuisine</li>
                <li>Know history of the city</li>
                <li>Visit museums</li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="tour_container">
          <div class="tour_box left">
            <div class="img">
              <img src="images/spain.jpg" alt="spain">
              <span class="rate">$5,200</span>
              <span class="more"><a href="#">More Info..</a></span>
            </div>
            <div class="description">
              <h2>Spain</h2>
              <p>May 22 - May 28</p>
              <ul>
                <li>Visit the city</li>
                <li>Try local cuisine</li>
                <li>Know history of the city</li>
                <li>Visit museums</li>
              </ul>
            </div>
          </div>

          <div class="tour_box right">
            <div class="img">
              <img src="images/venice.jpg" alt="venice">
              <span class="rate">$6,500</span>
              <span class="more"><a href="#">More Info..</a></span>
            </div>
            <div class="description">
              <h2>Venice</h2>
              <p>June 12 - June 23</p>
              <ul>
                <li>Visit the city</li>
                <li>Try local cuisine</li>
                <li>Know history of the city</li>
                <li>Visit museums</li>
              </ul>
            </div>
          </div>
        </div>
        
        <a href="#" id="link_more_tours">Get More Tours</a>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>