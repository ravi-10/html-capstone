<?php
    /**
     * Admin Testimonials Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\TestimonialModel;

    $title = 'ATG - Admin Testimonials';
    $heading = 'Testimonials';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view admin testimonials page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/testimonials.php');
        exit;
    }

    $obj_testimonoials = new TestimonialModel;
    $testimonials = $obj_testimonoials->all('title', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $testimonials = $obj_testimonoials->search($_POST['search']);
            if(count($testimonials)>0){
                $_SESSION['flash'] = count($testimonials) . " Testimonial(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No FAQ(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type title to search a testimonial";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: testimonials.php');
            die;
        }
    }

    if(!empty($_GET['delete_testimonial'])){
        $deleted = $obj_testimonoials->delete($_GET['delete_testimonial']);
        if($deleted>0){
            $_SESSION['flash'] = "testimonoial deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: testimonials.php');
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
                        <div class="spur-card-title">List of Testimonials</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_testimonials">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($testimonials as $testimonial):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <?=esc($testimonial['title'])?>
                                        </td>
                                        <td>
                                            <?=esc($testimonial['first_name']) . ' ' .
                                                esc($testimonial['last_name'])?>
                                        </td>
                                        <td class="description">
                                            <?=esc($testimonial['description'])?>
                                        </td>
                                        <td>
                                            <?php if($testimonial['is_published'] == true): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Not Published</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="manage_testimonial.php?testimonial_id=<?=esc_attr($testimonial['testimonial_id'])?>">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                            </a>
                                            <a href="testimonials.php?delete_testimonial=<?=esc_attr($testimonial['testimonial_id'])?>"
                                            onclick="return confirm('Are you sure to delete?')">
                                                <button type="button" class="btn btn-danger btn-sm mb-1">Delete</button>
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