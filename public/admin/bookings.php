<?php
    /**
     * Admin Bookings Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\BookingModel;

    $title = 'ATG - Admin Bookings';
    $heading = 'Bookings';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view bookings page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/bookings.php');
        exit;
    }

    $obj_bookings = new BookingModel;
    $bookings = $obj_bookings->all('created_at', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $bookings = $obj_bookings->search($_POST['search']);
            if(count($bookings)>0){
                $_SESSION['flash'] = count($bookings) . " Booking(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No Booking(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type something to search a booking 
                                    by user";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: bookings.php');
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
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of Bookings</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_bookings">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Booking Details</th>
                                    <th scope="col">Tour Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($bookings as $booking):

                                        $booking_line_items = $obj_bookings->getLineItems($booking['booking_id']);
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td class="customer">
                                            <span class="badge badge-light">
                                                Name
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['first_name']) .
                                                 ' ' . esc($booking['last_name'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                Address
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['customer_address'])?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light">
                                                Sub Total
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['sub_total'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                GST
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['gst'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                PST
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['pst'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                Total
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($booking['total'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                Status
                                            </span>
                                            <span class="badge badge-success">
                                                <?=esc($booking['status'])?>
                                            </span>
                                        </td>
                                        <td class="tour_details">
                                            <span class="badge badge-light">
                                                Tour Title
                                            </span>
                                            <span class="badge badge-secondary">
                                                Unit Price
                                            </span>
                                            <span class="badge badge-dark">
                                                Quantity
                                            </span>
                                            <br>
                                            <?php foreach ($booking_line_items as $line_item) : ?>
                                                <span class="badge badge-light">
                                                    <?=esc($line_item['title'])?>
                                                </span>
                                                <span class="badge badge-secondary">
                                                    <?=esc($line_item['unit_price'])?>
                                                </span>
                                                <span class="badge badge-dark">
                                                    <?=esc($line_item['quantity'])?>
                                                </span>
                                                <br>
                                            <?php endforeach; ?>
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