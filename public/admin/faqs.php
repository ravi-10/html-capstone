<?php
    /**
     * Admin FAQs Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\FaqsModel;

    $title = 'ATG - Admin FAQs';
    $heading = 'FAQs';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view admin faqs page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/faqs.php');
        exit;
    }

    $obj_faqs = new FaqsModel;
    $faqs = $obj_faqs->all('question', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $faqs = $obj_faqs->search($_POST['search']);
            if(count($faqs)>0){
                $_SESSION['flash'] = count($faqs) . " FAQ(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No FAQ(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type question to search a FAQ";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: faqs.php');
            die;
        }
    }

    if(!empty($_GET['delete_faq'])){
        $deleted = $obj_faqs->delete($_GET['delete_faq']);
        if($deleted>0){
            $_SESSION['flash'] = "faq deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: faqs.php');
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
                <a href="manage_faq.php" class="btn btn-primary mb-1">
                    Add New FAQ
                </a>
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of FAQs</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_faqs">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">FAQ</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($faqs as $faq):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <span class="badge badge-light">
                                                <?=esc($faq['question'])?>
                                            </span>
                                            <br>
                                            <span class="badge badge-dark">
                                                <?=esc($faq['answer'])?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($faq['is_published'] == true): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Not Published</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="manage_faq.php?faq_id=<?=esc_attr($faq['faq_id'])?>" class="btn btn-primary btn-sm mb-1">
                                                Edit
                                            </a>
                                            <a href="faqs.php?delete_faq=<?=esc_attr($faq['faq_id'])?>"
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