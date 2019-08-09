<?php
    /**
     * Blog Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - Blog';
    $heading = 'Blog';

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
        
        <div class="post">
          <img src="images/guidance.jpg" alt="guidance" width="200" height="200">
          <h2>Be Your Own Guide</h2>
          <span>By ATG on April 09, 2019</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis veritatis praesentium natus iure, facilis explicabo omnis sint quod quaerat fugit, ducimus aperiam deserunt laboriosam nihil repellendus? Inventore voluptate, maiores ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos, itaque iusto fugit quas quia sit quisquam, molestiae pariatur nulla odio sapiente officiis. Voluptatem aliquam voluptatum est culpa, cum sit.</p>
          <a href="#">read more..</a>
        </div>
        
        <div class="post">
          <img src="images/nature.jpg" alt="nature">
          <h2>Into the Unknown</h2>
          <span>By ATG on April 02, 2019</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis veritatis praesentium natus iure, facilis explicabo omnis sint quod quaerat fugit, ducimus aperiam deserunt laboriosam nihil repellendus? Inventore voluptate, maiores ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos, itaque iusto fugit quas quia sit quisquam, molestiae pariatur nulla odio sapiente officiis. Voluptatem aliquam voluptatum est culpa, cum sit.</p>
          <a href="#">read more..</a>
        </div>
        
        <div class="post">
          <img src="images/road-trip.jpg" alt="road trip">
          <h2>Plan a Road Trip for Summer</h2>
          <span>By ATG on March 24, 2019</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis veritatis praesentium natus iure, facilis explicabo omnis sint quod quaerat fugit, ducimus aperiam deserunt laboriosam nihil repellendus? Inventore voluptate, maiores ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos, itaque iusto fugit quas quia sit quisquam, molestiae pariatur nulla odio sapiente officiis. Voluptatem aliquam voluptatum est culpa, cum sit.</p>
          <a href="#">read more..</a>
        </div>
        
        <div class="post">
          <img src="images/lava.jpg" alt="lava">
          <h2>Essential Things to Experience Lava Safely</h2>
          <span>By ATG on March 15, 2019</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis veritatis praesentium natus iure, facilis explicabo omnis sint quod quaerat fugit, ducimus aperiam deserunt laboriosam nihil repellendus? Inventore voluptate, maiores ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos, itaque iusto fugit quas quia sit quisquam, molestiae pariatur nulla odio sapiente officiis. Voluptatem aliquam voluptatum est culpa, cum sit.</p>
          <a href="#">read more..</a>
        </div>
        
        <div class="post">
          <img src="images/camping.jpg" alt="camping">
          <h2>Beginners Tips for Camping</h2>
          <span>By ATG on March 09, 2019</span>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis veritatis praesentium natus iure, facilis explicabo omnis sint quod quaerat fugit, ducimus aperiam deserunt laboriosam nihil repellendus? Inventore voluptate, maiores ut. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt dignissimos, itaque iusto fugit quas quia sit quisquam, molestiae pariatur nulla odio sapiente officiis. Voluptatem aliquam voluptatum est culpa, cum sit.</p>
          <a href="#">read more..</a>
        </div>
        
        <a href="#" id="older_posts">Older Posts</a>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>