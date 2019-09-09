<?php
    /**
     * Single Blog Page 
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\BlogModel;

    $title = 'ATG - Blog Details';

    if(!isset($_GET['blog_id']) || empty($_GET['blog_id'])){
        $_SESSION['flash'] = "Please select a blog to view details";
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: blog.php');
        die;
    }

    $heading = 'Blog Details';

    $obj_blog = new BlogModel;
    $single_blog = $obj_blog->one($_GET['blog_id']);

    // including head file
    require '../inc/head.inc.php';

    // including header file
    require '../inc/header.inc.php';
?>
      
      <main>
        <div id="hero">
          <img src="images/banner.jpg" alt="banner image">
          <div>
            <h1><?=esc($single_blog['title'])?></h1>
          </div>
        </div>

        <div class="blog_container">

          <div class="blog_box">
            <?php
                  $author = $single_blog['first_name'] . ' ' . $single_blog['last_name'];
                  $published_on = $single_blog['published_at'];
            ?>
            <p>
              <strong>Author: </strong><?=esc($author)?>
            </p>
            <p>
              <strong>Published On: </strong><?=esc($published_on)?>
            </p>
            <div class="img">
              <img src="images/uploads/blogs/featured/<?=esc_attr($single_blog['featured_image'])?>" alt="<?=esc_attr($single_blog['featured_image'])?>">
            </div>
            <div class="description">
              
              <p><?=esc($single_blog['description'])?></p>
              
            </div>
          </div>
        </div>        
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>