<?php
    /**
     * Single Tour Page 
     * last_update: 2019-09-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\TourModel;
    use App\ItinerariesModel;

    $title = 'ATG - Tour Details';

    if(!isset($_GET['tour_id']) || empty($_GET['tour_id'])){
        $_SESSION['flash'] = "Please select a tour to view details";
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: tours.php');
        die;
    }

    $heading = 'Tour Details';

    $obj_tour = new TourModel;
    $single_tour = $obj_tour->one($_GET['tour_id']);

    $obj_itineraries = new ItinerariesModel;
    $tour_itineraries = $obj_itineraries->tourItineraries($single_tour['tour_id']);

    // including head file
    require '../inc/head.inc.php';

    // including header file
    require '../inc/header.inc.php';
?>
      
      <main>
        <div id="hero">
          <img src="images/banner.jpg" alt="banner image">
          <div>
            <h1><?=esc($single_tour['title'])?></h1>
          </div>
        </div>

        <div class="tour_container">

          <div class="tour_box">
            <button id="book_now">Add to Cart</button>
            <p class="warn">
              <?php
                  $obj_from_date = date_create($single_tour['from_date']);
                  $obj_to_date = date_create($single_tour['to_date']);
                    
                  // calculates the difference between both Date objects
                  $difference = date_diff($obj_from_date, $obj_to_date);
                    
                  // Format difference into days 
                  $days = $difference->format('%a');

                  $booking_ends = "Booking ends in $days days";

                  echo esc($booking_ends);
              ?>
              <span class="small">
                (maximum allowed bookings per user: <?=esc($single_tour['max_allowed_bookings'])?>)
              </span>
            </p>
            <div class="img">
              <img src="images/uploads/tours/featured/<?=esc_attr($single_tour['featured_image'])?>" alt="<?=esc_attr($single_tour['featured_image'])?>">
              <span class="rate">
                <?php
                  $price = '$ ' . $single_tour['price'];
                  echo esc($price);
                ?>
              </span>
              <span class="more country"><a href="#"><?=esc($single_tour['country'])?></a></span>
            </div>
            <div class="description">
              <p>
                <strong>
                  <?php
                      $formatted_from_date = date('F d, Y', strtotime($single_tour['from_date']));
                      $formatted_to_date = date('F d, Y', strtotime($single_tour['to_date']));

                      $duration = $formatted_from_date . ' - ' . $formatted_to_date;
                      echo esc($duration);
                  ?>
                </strong>
              </p>
              <p>
                <em>
                  <?php
                    $category = 'Category - ' . $single_tour['category'];
                    echo esc($category);
                  ?>
                </em>
              </p>
              
              <p class="justify">
                <?=esc($single_tour['description'])?>
              </p>
              
              <h3>Itineraries</h3>
              <?php if(count($tour_itineraries) > 0) : ?>
                <ul>
                  <?php foreach ($tour_itineraries as $itinerary) : ?>
                    <li>
                      <strong><?=esc($itinerary['name'])?>: </strong>
                      <span><?=esc($itinerary['description'])?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php else : ?>
                <p>There is no itinerary assigned to this tour.</p>
              <?php endif; ?>
              
            </div>
          </div>
        </div>        
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>