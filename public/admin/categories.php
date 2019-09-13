<?php
    /**
     * Admin Category Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\CategoryModel;

    $title = 'ATG - Admin Categories';
    $heading = 'Categories';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view categories page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/categories.php');
        exit;
    }

    $obj_category = new CategoryModel;
    $categories = $obj_category->all('name', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $categories = $obj_category->search($_POST['search']);
            if(count($categories)>0){
                $_SESSION['flash'] = count($categories) . " Categories(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No Categories(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type name to search a category";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: categories.php');
            die;
        }
    }

    if(!empty($_GET['delete_category'])){
        $deleted = $obj_category->delete($_GET['delete_category']);
        if($deleted>0){
            $_SESSION['flash'] = "category deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: categories.php');
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
                <a href="manage_category.php">
                    <button type="button" class="btn btn-primary mb-1">
                        Add New Category
                    </button>
                </a>
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of Categories</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_categories">
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
                                    foreach($categories as $category):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <?=esc($category['name'])?>
                                        </td>
                                        <td class="description">
                                            <?=esc($category['description'])?>
                                        </td>
                                        <td>
                                            <a href="manage_category.php?category_id=<?=esc_attr($category['category_id'])?>">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                            </a>
                                            <a href="categories.php?delete_category=<?=esc_attr($category['category_id'])?>"
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