<?php
    /**
     * Testimonials Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\TestimonialModel;

    $title = 'ATG - Testimonials';
    $heading = 'Testimonials';

    $obj_testimonial = new TestimonialModel;
    $testimonials = $obj_testimonial->all('created_at', 'frontend');

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
        
        <?php foreach ($testimonials as $testimonial) : ?>
          <div class="testimonial">
            <h2><?=esc($testimonial['title'])?></h2>
            <div class="content">
              <p><?=esc($testimonial['description'])?></p>
              <span>- <?=esc($testimonial['first_name'] . ' ' . $testimonial['last_name'])?></span>
            </div>
          </div>
        <?php endforeach; ?>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>