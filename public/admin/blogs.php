<?php
    /**
     * Admin Blog Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\BlogModel;

    $title = 'ATG - Admin Blogs';
    $heading = 'Blogs';

    if(!$_SESSION['logged_in'] && 
        ($_SESSION['role'] != 'admin' || $_SESSION['role'] != 'blogger')) {
        $_SESSION['flash'] = 'You must be logged in as admin or blogger
                                 to view admin blogs page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/blogs.php');
        exit;
    }

    $obj_blog = new BlogModel;
    $blogs = $obj_blog->all('title', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $blogs = $obj_blog->search('created_at', 'backend', $_POST['search']);
            if(count($blogs)>0){
                $_SESSION['flash'] = count($blogs) . " Blog(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No Blog(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type something to search a blog by title";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: blogs.php');
            die;
        }
    }

    if(!empty($_GET['delete_blog'])){
        $deleted = $obj_blog->delete($_GET['delete_blog']);
        if($deleted>0){
            $_SESSION['flash'] = "Blog deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: blogs.php');
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
                <a href="manage_blog.php">
                    <button type="button" class="btn btn-primary mb-1">
                        Add New Blog
                    </button>
                </a>
                <div class="card spur-card">
                    <div class="card-header bg-secondary text-white">
                        <div class="spur-card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="spur-card-title">List of Blogs</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_blogs">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Blog Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($blogs as $blog):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td class="title">
                                            <?=esc($blog['title'])?>
                                            <img 
                                                src="../images/uploads/blogs/thumbnail/<?=esc_attr($blog['thumbnail_image'])?>"
                                                class="img-fluid" 
                                                alt="<?=esc_attr($blog['thumbnail_image'])?>">
                                        </td>
                                        <td>
                                            <span class="badge badge-light">
                                                Author
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($blog['first_name'] . ' ' . $blog['last_name'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                published on
                                            </span>
                                            <span class="badge badge-dark">
                                                <?=esc($blog['published_at'])?>
                                            </span>
                                            <br />
                                            <span class="badge badge-light">
                                                Comments
                                            </span>
                                            <span class="badge badge-dark">
                                                <?php
                                                    if($blog['allow_comments']){
                                                        echo esc('Allowed');
                                                    } else {
                                                        echo esc('Not Allowed');
                                                    }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($blog['is_published'] == true): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Not Published</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="manage_blog.php?blog_id=<?=esc_attr($blog['blog_id'])?>">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                            </a>
                                            <a href="blogs.php?delete_blog=<?=esc_attr($blog['blog_id'])?>"
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