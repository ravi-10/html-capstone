<?php
    /**
     * Blog Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\BlogModel;

    $title = 'ATG - Blog';
    $heading = 'Blog';

    $obj_blog = new BlogModel;
    
    if(!empty($_POST)) {
        if(!empty($_POST['search'])){
            $blogs = $obj_blog->search('published_at', 'frontend', $_POST['search']);
            if(count($blogs) > 0){
                $_SESSION['flash'] = count($blogs) .' blog(s) found';
                $_SESSION['flash_class'] = 'flash-success';
            } else {
                $_SESSION['flash'] = 'No blog found. Please try again.';
                $_SESSION['flash_class'] = 'flash-info';
            }
        } else {
            $_SESSION['flash'] = "Please type something to search a blog by title";
            $_SESSION['flash_class'] = 'flash-info';
            header('Location: blog.php');
            die;
        }
    } else {
        $blogs = $obj_blog->all('published_at', 'frontend');
    }

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
          <div class="search">
            <form method="post" action="<?=esc_attr($_SERVER['PHP_SELF'])?>">
              <input type="text" class="txt_search" name="search" placeholder="search by title" value="<?=clean('search')?>">
              <button type="submit">Search</button>
            </form>
          </div>
        </div>

        <div class="flash <?=$_SESSION['flash_class']?>">
            <?php require __DIR__ . '/../inc/flash.inc.php'; ?>
        </div>
        
        <?php 
            if (count($blogs) > 0) :
              foreach ($blogs as $blog) : 
        ?>

          <div class="post">
            <img src="images/uploads/blogs/thumbnail/<?=esc_attr($blog['thumbnail_image'])?>" alt="<?=esc_attr($blog['thumbnail_image'])?>" width="200" height="200">
            <h2><?=esc($blog['title'])?></h2>
            <span>
              <?php
                  $author = $blog['first_name'] . ' ' . $blog['last_name'];
                  $formatted_published_date = date('F d, Y', strtotime($blog['published_at']));
                  $published_info = "By $author on $formatted_published_date";
                  echo esc($published_info);
              ?>
            </span>
            <p><?=esc(mb_substr($blog['description'], 0, 100, 'UTF-8'))?></p>
            <a href="single_blog.php?blog_id=<?=esc_attr($blog['blog_id'])?>">read more..</a>
          </div>
          
        <?php 
              endforeach;
            else :
              if(empty($_POST['search'])) :
        ?>
            <div class="no_data">
              <p>There is no blog available</p>
            </div>
        <?php
              endif;
            endif; 
        ?>
      
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>