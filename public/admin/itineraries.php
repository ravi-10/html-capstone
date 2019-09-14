<?php
    /**
     * Admin Itineraries Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\ItinerariesModel;

    $title = 'ATG - Admin Itineraries';
    $heading = 'Itineraries';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view admin itineraries page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/itineraries.php');
        exit;
    }

    $obj_itineraries = new ItinerariesModel;
    $itineraries = $obj_itineraries->all('name', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $itineraries = $obj_itineraries->search($_POST['search']);
            if(count($itineraries)>0){
                $_SESSION['flash'] = count($itineraries) . " Itineraries(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No Itineraries(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type name to search a itineraries";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: itineraries.php');
            die;
        }
    }

    if(!empty($_GET['delete_itinerary'])){
        $deleted = $obj_itineraries->delete($_GET['delete_itinerary']);
        if($deleted>0){
            $_SESSION['flash'] = "itinerary deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: itineraries.php');
            die;
        }
    }

    // including head file
    require '../../inc/admin_head.inc.php';
?>
        <?php require __DIR__ . '/../../inc/admin_flash.inc.php'; ?>
        <h1 class="dash-title"><?=esc($heading)?></h1>

        <div class="row">
            <div class="col">
                <a href="manage_itinerary.php" class="btn btn-primary mb-1">
                    Add New Itinerary
                </a>
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of Itineraries</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_itineraries">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($itineraries as $itinerary):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <?=esc($itinerary['name'])?>
                                        </td>
                                        <td class="description">
                                            <?=esc($itinerary['description'])?>
                                        </td>
                                        <td>
                                            <a href="manage_itinerary.php?itinerary_id=<?=esc_attr($itinerary['itinerary_id'])?>"
                                                class="btn btn-primary btn-sm mb-1">
                                                Edit
                                            </a>
                                            <a href="itineraries.php?delete_itinerary=<?=esc_attr($itinerary['itinerary_id'])?>"
                                            onclick="return confirm('Are you sure to delete?')"
                                            class="btn btn-danger btn-sm mb-1">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $sr_no++;
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                        
<?php
    // including footer file
    require '../../inc/admin_footer.inc.php';
?>