<?php
    /**
     * Admin Manage Blog Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\BlogModel;
    use App\UserModel;
    use App\Validator;

    if(!$_SESSION['logged_in'] && 
        ($_SESSION['role'] != 'admin' || $_SESSION['role'] != 'blogger')) {
        $_SESSION['flash'] = 'You must be logged in as admin or blogger
                                 to view manage blog page.';
        $_SESSION['flash_class'] = 'flash-info';
        if(!empty($_GET['blog_id'])){
            header('Location: ../login.php?request_from=admin/manage_blog.php?blog_id=' . $_GET['blog_id']);
        } else {
            header('Location: ../login.php?request_from=admin/manage_blog.php');
        }
        exit;
    }

    $obj_blog = new BlogModel;
    $obj_user = new UserModel;

    if(!empty($_GET['blog_id'])){
        $title = 'ATG - Admin Edit Blog';
        $heading = 'Edit Blog';

        $blog_id = $_GET['blog_id'];
        $blog = $obj_blog->one($blog_id);
    } else {
        $title = 'ATG - Admin Add Blog';
        $heading = 'Add Blog';
    }

    $users = $obj_user->allBloggers('first_name', 'backend');

    $errors = [];
    $v = new Validator;

    if('POST' == $_SERVER['REQUEST_METHOD']) {

        // validate every POST submission for the csrf token
        if(empty($_POST['csrf']) || $_POST['csrf'] != $_SESSION['csrf']) {
            $_SESSION['flash'] = "Your session appears to have expired. 
                                  CSRF token mismatch! Please try again.";
            $_SESSION['flash_class'] = 'alert-danger';
            header('Location: blogs.php');
            die;
        }

        foreach ($_POST as $key => $value) {
            // calling required function for all fields except is_published 
            // because it is a checkbox
            if ($key != 'is_published'){
                $v->required($key);
            }
        }
        $v->generalStringValidator('title');
        $v->lengthForFullVarchar('title');
        $v->dateTimeFormat('published_at');

        $errors = $v->getErrors();

        if(empty($errors)) {
            
            $featured_image = "default-featured.jpg";
            if(!empty($_GET['blog_id'])){
                $featured_image = $_POST['prev_featured'];
            }
            if(!empty($_FILES['featured_image']['tmp_name'])) {
                $target_path = '../images/uploads/blogs/featured/';
                $file_name = $_FILES['featured_image']['name'];
                
                $file_name = uniqid() . '-' . $_FILES['featured_image']['name'];
                $source = $_FILES['featured_image']['tmp_name'];
                $destination = $target_path . $file_name;
                if(getimagesize($source)) {
                    move_uploaded_file($source, $destination);
                    $featured_image = $file_name;
                } else {
                    $errors['featured_image'] = 'The file you uploaded was not an image!';
                }
            }

            $thumbnail_image = "default-thumbnail.jpg";
            if(!empty($_GET['blog_id'])){
                $thumbnail_image = $_POST['prev_thumb'];
            }
            if(!empty($_FILES['thumbnail_image']['tmp_name'])) {
                $target_path = '../images/uploads/blogs/thumbnail/';
                $file_name = $_FILES['thumbnail_image']['name'];
                
                $file_name = uniqid() . '-' . $_FILES['thumbnail_image']['name'];
                $source = $_FILES['thumbnail_image']['tmp_name'];
                $destination = $target_path . $file_name;
                if(getimagesize($source)) {
                    move_uploaded_file($source, $destination);
                    $thumbnail_image = $file_name;
                } else {
                    $errors['thumbnail_image'] = 'The file you uploaded was not an image!';
                }
            }

            if(!empty($_GET['blog_id'])){
                $affected_row = $obj_blog->update($_POST, $featured_image, $thumbnail_image);
                if($affected_row>0) {
                    $_SESSION['flash'] = "Blog updated successfully";
                    $_SESSION['flash_class'] = 'alert-success';
                    header('Location: blogs.php');
                    die;
                }
            } else {
                $inserted_row = $obj_blog->save($_POST, $featured_image, $thumbnail_image);
                if($inserted_row>0) {
                    $_SESSION['flash'] = "Blog inserted successfully";
                    $_SESSION['flash_class'] = 'alert-success';
                    header('Location: blogs.php');
                    die;
                }
            }
        }

    }

    // including head file
    require '../../inc/admin_head.inc.php';
?>

        <h1 class="dash-title"><?=esc($heading)?></h1>

        <div class="row">
            <div class="col">
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="spur-card-title"> Blog Form </div>
                    </div>
                    <div class="card-body">
                        <form method="post" 
                            action="<?php
                                if(!empty($_GET['blog_id'])){
                                    echo esc_attr($_SERVER['PHP_SELF'] . '?blog_id=' . $_GET['blog_id']);
                                } else {
                                    echo esc_attr($_SERVER['PHP_SELF']);
                                }
                            ?>" 
                            id="blog" enctype="multipart/form-data" 
                            novalidate>
                            <input type="hidden" name="csrf" 
                            value="<?=esc_attr(csrf())?>" />

                            <?php if(!empty($_GET['blog_id'])) : ?>
                            <div class="form-group">
                                <input type="hidden" class="form-control" 
                                    id="blog_id" name="blog_id" 
                                    value="<?=cleanBackend('blog_id', $blog['blog_id'])?>">
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" 
                                    id="title" name="title" placeholder="Title" 
                                    value="<?php
                                    if(!empty($_GET['blog_id'])){
                                        echo cleanBackend('title', $blog['title']);
                                    } else {
                                        echo clean('title');
                                    }
                                    ?>">
                                <?php if(!empty($errors['title'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['title'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="category">Author</label>
                                <select class="form-control" id="author" 
                                    name="author">
                                    <option value="">Select Author</option>
                                    <?php foreach($users as $user) : ?>
                                      <option value="<?=esc_attr($user['user_id'])?>" 
                                        <?php
                                        if(!empty($_GET['blog_id'])){
                                            if($user['user_id'] == cleanBackend('author', $blog['user_id'])) {
                                                echo 'selected';
                                            } else {
                                                echo '';
                                            }
                                        } else {
                                            if($user['user_id'] == clean('author')) {
                                                echo 'selected';
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>>
                                        <?=esc($user['first_name'] . ' ' . 
                                            $user['last_name'])?>
                                      </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if(!empty($errors['author'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['author'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                                <?php
                                if(!empty($_GET['blog_id'])) :
                                    $featured = cleanBackend('prev_featured', $blog['featured_image']);
                                    if(!empty($featured)) :
                                ?>
                                    <div class="featured">
                                        <img 
                                        src="../images/uploads/blogs/featured/<?=esc_attr($featured)?>"
                                        class="img-fluid" 
                                        alt="<?=esc_attr($featured)?>">
                                        <input type="hidden" name="prev_featured"
                                        value="<?=esc_attr($featured)?>">
                                    </div>
                                    <small><?=esc($featured)?></small>
                                <?php 
                                    endif;
                                endif;
                                ?>
                                <input type="file" class="form-control" 
                                    id="featured_image" name="featured_image"
                                    placeholder="Featured Image"
                                    value="<?php
                                    if(!empty($_GET['blog_id'])){
                                        echo cleanBackend('featured_image', $blog['featured_image']);
                                    } else {
                                        echo clean('featured_image');
                                    }
                                    ?>">
                                <?php if(!empty($errors['featured_image'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['featured_image'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image</label>
                                <?php
                                if(!empty($_GET['blog_id'])) :
                                    $thumb = cleanBackend('prev_thumb', $blog['thumbnail_image']);
                                    if(!empty($thumb)) :
                                ?>
                                    <div class="thumbnail">
                                        <img 
                                        src="../images/uploads/blogs/thumbnail/<?=esc_attr($thumb)?>"
                                        class="img-fluid" 
                                        alt="<?=esc_attr($thumb)?>">
                                        <input type="hidden" name="prev_thumb"
                                        value="<?=esc_attr($thumb)?>">
                                    </div>
                                    <small><?=esc($thumb)?></small>
                                <?php 
                                    endif;
                                endif;
                                ?>
                                <input type="file" class="form-control" 
                                    id="thumbnail_image" name="thumbnail_image"
                                    placeholder="Thumbnail Image"
                                    value="<?php
                                    if(!empty($_GET['blog_id'])){
                                        echo cleanBackend('thumbnail_image', $blog['thumbnail_image']);
                                    } else {
                                        echo clean('thumbnail_image');
                                    }
                                    ?>">
                                <?php if(!empty($errors['thumbnail_image'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['thumbnail_image'])?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" 
                                    name="description" 
                                    rows="3"><?php
                                    if(!empty($_GET['blog_id'])){
                                        echo cleanBackend('description', $blog['description']);
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

                            <div class="form-group">
                                <label for="published_at">Published At</label>
                                <input type="text" class="form-control" 
                                        id="published_at" name="published_at" 
                                        placeholder="Published At" 
                                        value="<?php
                                        if(!empty($_GET['blog_id'])){
                                            echo cleanBackend('published_at', $blog['published_at']);
                                        } else {
                                            echo clean('published_at');
                                        }
                                        ?>">
                                <?php if(!empty($errors['published_at'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?=esc($errors['published_at'])?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                    id="is_published" name="is_published" 
                                    <?php
                                    if(!empty($_GET['blog_id'])){
                                        if(cleanBackend('is_published', $blog['is_published'])) {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        if(clean('is_published')) {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>>
                                    <label class="custom-control-label" for="is_published">is Published?</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                    id="allow_comments" name="allow_comments" 
                                    <?php
                                    if(!empty($_GET['blog_id'])){
                                        if(cleanBackend('allow_comments', $blog['allow_comments'])) {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        if(clean('allow_comments')) {
                                            echo 'checked';
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>>
                                    <label class="custom-control-label" for="allow_comments">Allow Comments?</label>
                                </div>
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