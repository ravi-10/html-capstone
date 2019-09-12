<?php
    /**
     * Admin Dashboard Page 
     * last_update: 2019-09-12
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    $title = 'ATG - Admin Dashboard';
    $heading = 'Dashboard';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view dashboard page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/');
        exit;
    }

    // including head file
    require '../../inc/admin_head.inc.php';
?>

        <h1 class="dash-title"><?=esc($heading)?></h1>
        
        
<?php
    require '../../inc/admin_under_construction.inc.php';

    // including footer file
    require '../../inc/admin_footer.inc.php';
?>