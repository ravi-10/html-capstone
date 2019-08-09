<?php
    /**
     * About Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../app/atg_config.php';

    $title = 'ATG - About';
    $heading = 'About Us';

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
        
        <div id="about_content">
         
          <img src="images/travel1.jpg" alt="travel picture" class="right">
          
          <p>In ut ornare mauris. Etiam congue cursus nulla et pellentesque. Aenean metus sem, placerat vel leo id, egestas rutrum nisl. Nam ut dui elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum lacinia diam justo, eu vehicula felis tincidunt a. Phasellus interdum lectus at ipsum dapibus sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed congue malesuada enim, ut hendrerit mi vestibulum ac. Integer nibh orci, ornare vel lorem eget, blandit gravida ipsum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum ut tincidunt ipsum. Aliquam odio quam, mollis ut suscipit ut, volutpat vel orci. Donec gravida feugiat mauris, id mattis augue tristique a.</p>
          
          <p>Mauris vel ipsum id magna porta blandit. Nunc laoreet dictum felis sed posuere. Donec non porta augue, in egestas dolor. Praesent tempor consectetur pharetra. Sed et sollicitudin nisl. Phasellus posuere aliquet eros, ac malesuada lectus congue eu. Aliquam faucibus volutpat lectus, a ullamcorper neque lobortis vel.</p>
          
          <img src="images/travel2.jpg" alt="another travel picture" class="left">
          
          <p>Praesent non pretium dui, id interdum sapien. Proin fringilla id ex a mattis. Fusce faucibus augue orci, et dapibus eros volutpat sed. Integer at feugiat ex. Ut convallis elementum maximus. Suspendisse sapien enim, porta eget consectetur eget, accumsan a orci. Proin elementum est vel blandit volutpat. Nulla facilisi. Maecenas sagittis urna arcu, ut scelerisque ligula egestas a. Pellentesque vel hendrerit ligula, vel fermentum magna. Mauris lobortis lacus eget nibh posuere, vel finibus massa feugiat. Mauris iaculis vestibulum varius. Vivamus consequat orci id aliquam blandit. Maecenas sit amet placerat ipsum. Nulla dolor metus, consectetur quis lectus in, pellentesque rhoncus magna. Nunc viverra vel lectus sed fringilla.</p>
          
        </div>
        
        <table id="timeline">
          <caption>Timeline</caption>
          <tr>
            <th>Year</th>
            <th>Bookings</th>
            <th>Ratings</th>
          </tr>
          
          <tr>
            <td>2018</td>
            <td>985</td>
            <td>4.8</td>
          </tr>
          
          <tr>
            <td>2017</td>
            <td>824</td>
            <td>4.5</td>
          </tr>
          
          <tr>
            <td>2016</td>
            <td>705</td>
            <td>4.2</td>
          </tr>
          
          <tr>
            <td>2015</td>
            <td>610</td>
            <td>4.0</td>
          </tr>
          
          <tr>
            <td>2014</td>
            <td>525</td>
            <td>3.8</td>
          </tr>
          
          <tr>
            <td>2013</td>
            <td>440</td>
            <td>3.6</td>
          </tr>
          
          <tr>
            <td>2012</td>
            <td>374</td>
            <td>3.5</td>
          </tr>
        </table>
      </main>
      
      <?php
          // including footer file
          require '../inc/footer.inc.php';
      ?>