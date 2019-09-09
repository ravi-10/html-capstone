<?php
    /**
     * FAQs Page 
     * last_update: 2019-09-09
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    use App\FaqsModel;

    $title = 'ATG - FAQs';
    $heading = 'FAQs';

    $obj_faqs = new FaqsModel;
    $faqs = $obj_faqs->all('created_at', 'frontend');

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
        
        <?php foreach ($faqs as $faq) : ?>
          <div class="faq">
            <h2><?=esc($faq['question'])?></h2>
            <div class="content">
              <p><?=esc($faq['answer'])?></p>
            </div>
          </div>
        <?php endforeach; ?>
        
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>