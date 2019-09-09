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

    $featured_tour = $obj_home->featuredTour();

    $upcoming_tours = $obj_home->upcomingTours();

    $recent_blogs = $obj_home->recentBlogs();

    // including head file
    require '../inc/head.inc.php';

    // including header file
    require '../inc/header.inc.php';
?>
      
      <main>
        <div id="hero">
          <img src="images/hero_image.jpg" alt="hero image">
          <div id="cta">
            <h1><?=esc($featured_tour['title'])?></h1>
            <p><?=esc(substr($featured_tour['description'], 0, 100, 'UTF-8'))?></p>
            <a href="single_tour.php?tour_id=<?=esc_attr($featured_tour['tour_id'])?>">Book Now</a>
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
          <?php foreach ($recent_blogs as $blog) : ?>
            <a href="single_blog.php?blog_id=<?=esc($blog['blog_id'])?>">
              <div class="blog">
                <img src="images/uploads/blogs/thumbnail/<?=esc_attr($blog['thumbnail_image'])?>" alt="<?=esc_attr($blog['thumbnail_image'])?>">
                <div class="overlay">
                  <div><?=esc($blog['title'])?></div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
          
          <a href="blog.php" id="blog_read_more">
            <div class="blog">
              <div class="overlay">
                <div>More...</div>
              </div>
            </div>
          </a>
        </div>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>