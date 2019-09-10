<?php
    /**
     * Tours Page 
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\TourModel;
    use App\CategoryModel;

    $title = 'ATG - Tours';
    $heading = 'Tours';

    $obj_tour = new TourModel;
    

    if(!empty($_GET['category_id'])){
        $tours = $obj_tour->allByCategory('from_date', 'frontend', $_GET['category_id']);
    } elseif(!empty($_POST)) {
        
        if(!empty($_POST['search'])){
            $tours = $obj_tour->search('from_date', 'frontend', $_POST['search']);
            if(count($tours) > 0){
                $_SESSION['flash'] = count($tours) .' tour(s) found';
                $_SESSION['flash_class'] = 'flash-success';
            } else {
                $_SESSION['flash'] = 'No tour found. Please try again.';
                $_SESSION['flash_class'] = 'flash-info';
            }
        } else {
            $_SESSION['flash'] = "Please type something to search a tour by title";
            $_SESSION['flash_class'] = 'flash-info';
            header('Location: tours.php');
            die;
        }
    } else {
        $tours = $obj_tour->all('from_date', 'frontend');
    }

    $obj_category = new CategoryModel;
    $categories = $obj_category->all('name', 'frontend');

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
              <input type="text" class="txt_search" name="search" 
                placeholder="search by title or coutry" 
                value="<?=clean('search')?>">
              <button type="submit">Search</button>
            </form>
          </div>
        </div>

        <div class="flash <?=$_SESSION['flash_class']?>">
            <?php require __DIR__ . '/../inc/flash.inc.php'; ?>
        </div>

        <div class="categories">
          <a href="tours.php"
            class="<?php
              if(empty($_GET['category_id']) && empty($_POST['search'])){
                  echo esc_attr('selected');
              }
            ?>">All</a>
          <?php foreach ($categories as $category) : ?>
              <a href="tours.php?category_id=<?=esc_attr($category['category_id'])?>"
                  class="<?php
                      if(!empty($_GET['category_id'])){
                        if($category['category_id'] == $_GET['category_id']){
                            echo esc_attr('selected');
                        }
                      }
                  ?>"
                >
                <?=esc($category['name'])?>
              </a>
          <?php endforeach; ?>
        </div>

        <?php
          if (count($tours) > 0) :
            $counter = 0;
            $css_class_align = 'left';
          
            foreach ($tours as $tour) :
              $counter++;
              if($counter%2 == 1) {
                $css_class_align = 'left'; // class left for odd item
                echo '<div class="tour_container">'; // open tour container at every odd tour item
              } else {
                $css_class_align = 'right'; // class right for even item
              }
          ?>
              <div class="tour_box <?=esc_attr($css_class_align)?>">
                <div class="img">
                  <img src="images/uploads/tours/thumbnail/<?=esc_attr($tour['thumbnail_image'])?>" alt="<?=esc_attr($tour['thumbnail_image'])?>">
                  <span class="rate">
                    <?php
                      $price = '$ ' . $tour['price'];
                      echo esc($price);
                    ?>
                  </span>
                  <span class="more"><a href="single_tour.php?tour_id=<?=esc_attr($tour['tour_id'])?>">More Info..</a></span>
                </div>
                <div class="description">
                  <h2><?=esc($tour['country'])?></h2>
                  <p>
                    <?php
                        $formatted_from_date = date('F d, Y', strtotime($tour['from_date']));
                        $formatted_to_date = date('F d, Y', strtotime($tour['to_date']));

                        $duration = $formatted_from_date . ' - ' . $formatted_to_date;
                        echo esc($duration);
                    ?>
                  </p>
                  <br/>
                  <p><strong><?=esc($tour['title'])?></strong></p>
                  <p><?=esc(substr($tour['description'], 0, 100))?></p>
                  <br/>
                </div>
              </div>
            
          <?php
            // close tour container at every even tour item, also close if last item is odd
            if($counter%2 == 0) {
                echo '</div>'; // close tour container
              } else {
                if($counter == count($tours)){
                  echo '</div>';
                } 
              }
            endforeach;
          else :
            if(empty($_POST['search'])) :
        ?>

            <div class="no_data">
              <p>There is no tour available</p>
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