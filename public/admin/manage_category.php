<?php
    /**
     * Admin Manage Category Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\CategoryModel;
    use App\Validator;

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view manage category page.';
        $_SESSION['flash_class'] = 'flash-info';
        if(!empty($_GET['category_id'])){
            header('Location: ../login.php?request_from=admin/manage_category.php?category_id=' . $_GET['category_id']);
        } else {
            header('Location: ../login.php?request_from=admin/manage_category.php');
        }
        exit;
    }

    $obj_category = new CategoryModel;

    if(!empty($_GET['category_id'])){
        $title = 'ATG - Admin Edit Category';
        $heading = 'Edit Category';

        $category_id = $_GET['category_id'];
        $category = $obj_category->one($category_id);
    } else {
        $title = 'ATG - Admin Add Category';
        $heading = 'Add Category';
    }

    $errors = [];
    $v = new Validator;

    if('POST' == $_SERVER['REQUEST_METHOD']) {

        // validate every POST submission for the csrf token
        if(empty($_POST['csrf']) || $_POST['csrf'] != $_SESSION['csrf']) {
            $_SESSION['flash'] = "Your session appears to have expired. 
                                  CSRF token mismatch! Please try again.";
            $_SESSION['flash_class'] = 'alert-danger';
            header('Location: categories.php');
            die;
        }

        foreach ($_POST as $key => $value) {
            // calling required function for all fields
            $v->required($key);
        }
        $v->generalStringValidator('name');
        $v->generalLengthValidator('name');

        $errors = $v->getErrors();

        if(empty($errors)) {

            if(!empty($_GET['category_id'])){
                $rows = $obj_category->checkCategoryNameForUpdating($_POST['name'], $_GET['category_id']);
                if($rows>0) {
                    $_SESSION['flash'] = "category name already exists";
                    $_SESSION['flash_class'] = 'alert-info';
                } else {
                    $affected_row = $obj_category->update($_POST);
                    if($affected_row>0) {
                        $_SESSION['flash'] = "category updated successfully";
                        $_SESSION['flash_class'] = 'alert-success';
                        header('Location: categories.php');
                        die;
                    }
                }
            } else {
                $rows = $obj_category->checkCategoryNameForAdding($_POST['name']);
                if($rows>0) {
                    $_SESSION['flash'] = "category name already exists";
                    $_SESSION['flash_class'] = 'alert-info';
                } else {
                    $inserted_row = $obj_category->save($_POST);
                    if($inserted_row>0) {
                        $_SESSION['flash'] = "Category inserted successfully";
                        $_SESSION['flash_class'] = 'alert-success';
                        header('Location: categories.php');
                        die;
                    }
                }
            }
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
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Category Form </div>
                    </div>
                    <div class="card-body">
                        <form method="post" 
                            action="<?php
                                if(!empty($_GET['category_id'])){
                                    echo esc_attr($_SERVER['PHP_SELF'] . '?category_id=' . $_GET['category_id']);
                                } else {
                                    echo esc_attr($_SERVER['PHP_SELF']);
                                }
                            ?>" 
                            id="category" novalidate>
                            <input type="hidden" name="csrf" 
                            value="<?=esc_attr(csrf())?>" />

                            <?php if(!empty($_GET['category_id'])) : ?>
                            <div class="form-group">
                                <input type="hidden" class="form-control" 
                                    id="category_id" name="category_id" 
                                    value="<?=cleanBackend('category_id', $category['category_id'])?>">
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" 
                                    id="name" name="name" placeholder="Name" 
                                    value="<?php
                                    if(!empty($_GET['category_id'])){
                                        echo cleanBackend('name', $category['name']);
                                    } else {
                                        echo clean('name');
                                    }
                                    ?>">
                                <?php if(!empty($errors['name'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['name'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" 
                                    name="description" 
                                    rows="3"><?php
                                    if(!empty($_GET['category_id'])){
                                        echo cleanBackend('description', $category['description']);
                                    } else {
                                        echo clean('description');
                                    }
                                    ?></textarea>
                                <?php if(!empty($errors['description'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['description'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                        
<?php
    // including footer file
    require '../../inc/admin_footer.inc.php';
?>