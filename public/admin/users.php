<?php
    /**
     * Admin Users Page 
     * last_update: 2019-09-13
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
    
    require __DIR__ . '/../../app/atg_config.php';

    use App\UserModel;

    $title = 'ATG - Admin Users';
    $heading = 'Users';

    if(!$_SESSION['logged_in'] && $_SESSION['role'] != 'admin') {
        $_SESSION['flash'] = 'You must be logged in as admin
                                 to view users page.';
        $_SESSION['flash_class'] = 'flash-info';
        header('Location: ../login.php?request_from=admin/users.php');
        exit;
    }

    $obj_user = new UserModel;
    $users = $obj_user->all('first_name', 'backend');

    if('POST' == $_SERVER['REQUEST_METHOD']){
        if(!empty($_POST['search'])){
            $users = $obj_user->search($_POST['search']);
            if(count($users)>0){
                $_SESSION['flash'] = count($users) . " User(s) Found";
                $_SESSION['flash_class'] = 'alert-success';
            } else {
                $_SESSION['flash'] = "No User(s) Found";
                $_SESSION['flash_class'] = 'alert-info';
            }
        } else {
            $_SESSION['flash'] = "Please type user name to search a user";
            $_SESSION['flash_class'] = 'alert-info';
            header('Location: users.php');
            die;
        }
    }

    if(!empty($_GET['delete_user'])){
        $deleted = $obj_user->delete($_GET['delete_user']);
        if($deleted>0){
            $_SESSION['flash'] = "user deleted successfully";
            $_SESSION['flash_class'] = 'alert-success';
            header('Location: users.php');
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
                        <div class="spur-card-title">List of Users</div>
                    </div>
                    <div class="card-body card-body-with-dark-table">
                        <table class="table table-dark table-in-card" 
                            id="table_users">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sr_no = 1;
                                    foreach($users as $user):
                                ?>
                                    <tr>
                                        <th scope="row"><?=esc($sr_no)?></th>
                                        <td>
                                            <?=esc($user['first_name']) . ' ' .
                                                esc($user['last_name'])?>
                                        </td>
                                        <td>
                                            <?=esc($user['email'])?>
                                        </td>
                                        <td class="description">
                                            <?=esc($user['role'])?>
                                        </td>
                                        <td>
                                            <a href="manage_user.php?user_id=<?=esc_attr($user['user_id'])?>">
                                                <button type="button" class="btn btn-primary btn-sm mb-1">Edit</button>
                                            </a>
                                            <a href="users.php?delete_user=<?=esc_attr($user['user_id'])?>"
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