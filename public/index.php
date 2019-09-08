<?php
    /**
     * Home Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\HomeModel;

    $title = 'Around The Globe';

    $obj_home = new HomeModel;
    $upcoming_tours = $obj_home->upcomingTours();

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

          <?php foreach ($upcoming_tours as $tour) : ?>

            <div class="tour">
              <div class="title">
                <h3><?=esc($tour['country'])?></h3>
                <span>
                  <?php
                      $formatted_from_date = date('F d, Y', strtotime($tour['from_date']));
                      $formatted_to_date = date('F d, Y', strtotime($tour['to_date']));

                      $duration = $formatted_from_date . ' - ' . $formatted_to_date;
                      echo esc($duration);
                  ?>    
                </span>
              </div>
              <div class="tour_image">
                <img src="images/uploads/tours/thumbnail/<?=esc_attr($tour['thumbnail_image'])?>" alt="esc_attr($tour['thumbnail_image'])?>">
              </div>
              <div class="description">
                <p>
                  <?=esc($tour['description'])?>
                </p>
                <a href="single_tour.php?tour_id=<?=esc_attr($tour['tour_id'])?>">Read More</a>
              </div>
            </div>

          <?php endforeach; ?>
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