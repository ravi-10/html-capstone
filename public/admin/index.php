<?php
    /**
     * Admin Dashboard Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\DatabaseLogger;
    use App\DashboardModel;

    $title = 'ATG - Admin Dashboard';
    $heading = 'Dashboard';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view dashboard page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/');
        exit;
    }

    $obj_dashboard = new DashboardModel;
    $total_tours = $obj_dashboard->getTotal('tours');
    $total_users = $obj_dashboard->getTotal('users');
    $total_bookings = $obj_dashboard->getTotal('bookings');

    $tour = $obj_dashboard->getTourAggregates();

    $booking = $obj_dashboard->getBookingAggregates();

    $admin = $obj_dashboard->getTotalTypeOfUser('admin');
    $blogger = $obj_dashboard->getTotalTypeOfUser('blogger');
    $customer = $obj_dashboard->getTotalTypeOfUser('customer');

    $obj_logger = new DatabaseLogger;
    $logs = $obj_logger->recentLogs();

    // including head file
    require '../../inc/admin_head.inc.php';
?>
        <?php require __DIR__ . '/../../inc/admin_flash.inc.php'; ?>
        <h1 class="dash-title"><?=esc($heading)?></h1>
        
        <div class="row">
                <div class="col-lg-6">
                    <div class="card spur-card">
                        <div class="card-header bg-success text-white">
                            <div class="spur-card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="spur-card-title"> Overview </div>
                        </div>
                        <div class="card-body">
                            <span class="badge badge-secondary">
                                Total Tours
                            </span>
                            <span class="badge badge-success">
                                <?=esc($total_tours['total'])?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Total Users
                            </span>
                            <span class="badge badge-success">
                                <?=esc($total_users['total'])?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Total Bookings
                            </span>
                            <span class="badge badge-success">
                                <?=esc($total_bookings['total'])?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card spur-card">
                        <div class="card-header bg-primary text-white">
                            <div class="spur-card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="spur-card-title"> Tours </div>
                        </div>
                        <div class="card-body">
                            <span class="badge badge-secondary">
                                Maximum Price
                            </span>
                            <span class="badge badge-primary">
                                <?=esc(number_format($tour['max_price'], 2))?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Minimum Price
                            </span>
                            <span class="badge badge-primary">
                                <?=esc(number_format($tour['min_price'], 2))?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Average Price
                            </span>
                            <span class="badge badge-primary">
                                <?=esc(number_format($tour['avg_price'], 2))?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card spur-card">
                        <div class="card-header bg-info text-white">
                            <div class="spur-card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="spur-card-title"> Bookings </div>
                        </div>
                        <div class="card-body">
                            <span class="badge badge-secondary">
                                Maximum Booking
                            </span>
                            <span class="badge badge-info">
                                <?=esc(number_format($booking['max_total'], 2))?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Minimum Booking
                            </span>
                            <span class="badge badge-info">
                                <?=esc(number_format($booking['min_total'], 2))?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Average Booking
                            </span>
                            <span class="badge badge-info">
                                <?=esc(number_format($booking['avg_total'], 2))?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card spur-card">
                        <div class="card-header bg-danger text-white">
                            <div class="spur-card-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="spur-card-title"> Users </div>
                        </div>
                        <div class="card-body">
                            <span class="badge badge-secondary">
                                Admin
                            </span>
                            <span class="badge badge-danger">
                                <?=esc($admin['total'])?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Blogger
                            </span>
                            <span class="badge badge-danger">
                                <?=esc($blogger['total'])?>
                            </span>
                            <br />
                            <span class="badge badge-secondary">
                                Customer
                            </span>
                            <span class="badge badge-danger">
                                <?=esc($customer['total'])?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of Recent Logs (Last 15)</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_logs">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Event Log</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($logs as $log):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <span class="badge badge-light">
                                                <?=esc($log['event'])?>
                                            </span>
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