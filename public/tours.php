<?php
    /**
     * Tours Page 
     * last_update: 2019-08-23
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\TourModel;

    $title = 'ATG - Tours';
    $heading = 'Tours';

    $obj_tour = new TourModel;
    $tours = $obj_tour->all('from_date');

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

        <?php
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
                <span class="more"><a href="tour_details.php?tour_id=<?=esc_attr($tour['tour_id'])?>">More Info..</a></span>
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
                <p><?=esc(mb_substr($tour['description'], 0, 100, 'UTF-8'))?></p>
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
        ?>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>